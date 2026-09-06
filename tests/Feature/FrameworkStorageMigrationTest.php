<?php

namespace Tests\Feature;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class FrameworkStorageMigrationTest extends TestCase
{
    public function test_migration_creates_all_framework_storage_tables_on_an_empty_database(): void
    {
        $this->migration()->up();

        $this->assertSame(
            ['id', 'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'],
            Schema::getColumnListing('sessions'),
        );
        $this->assertSame(['key', 'value', 'expiration'], Schema::getColumnListing('cache'));
        $this->assertSame(['key', 'owner', 'expiration'], Schema::getColumnListing('cache_locks'));
    }

    /**
     * @param  list<string>  $existingTables
     */
    #[DataProvider('existingTableCombinations')]
    public function test_migration_preserves_existing_tables_and_creates_only_missing_tables(array $existingTables): void
    {
        foreach ($existingTables as $table) {
            Schema::create($table, function (Blueprint $blueprint): void {
                $blueprint->id();
                $blueprint->string('sentinel');
            });

            DB::table($table)->insert(['sentinel' => "preserve-{$table}"]);
        }

        $this->migration()->up();

        foreach (['sessions', 'cache', 'cache_locks'] as $table) {
            $this->assertTrue(Schema::hasTable($table));

            if (in_array($table, $existingTables, true)) {
                $this->assertTrue(Schema::hasColumn($table, 'sentinel'));
                $this->assertSame("preserve-{$table}", DB::table($table)->value('sentinel'));
            }
        }
    }

    public static function existingTableCombinations(): array
    {
        return [
            'sessions exists' => [['sessions']],
            'cache exists' => [['cache']],
            'cache locks exists' => [['cache_locks']],
            'sessions and cache exist' => [['sessions', 'cache']],
            'sessions and cache locks exist' => [['sessions', 'cache_locks']],
            'cache and cache locks exist' => [['cache', 'cache_locks']],
            'all tables exist' => [['sessions', 'cache', 'cache_locks']],
        ];
    }

    private function migration(): Migration
    {
        return require database_path('migrations/2026_09_05_000002_create_framework_storage_tables.php');
    }
}
