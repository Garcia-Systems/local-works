<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use RuntimeException;

class InsightContent
{
    private const REQUIRED = ['title', 'slug', 'summary', 'published_at', 'type'];

    private const TYPES = ['insight', 'observation', 'example', 'case-study'];

    public function __construct(private ?string $path = null)
    {
        $this->path ??= resource_path('content/insights');
    }

    public function published(): Collection
    {
        return $this->all()
            ->reject(fn (array $article) => $article['draft'] || $article['published_at']->isFuture())
            ->sortByDesc('published_at')
            ->values();
    }

    public function findPublished(string $slug): ?array
    {
        return $this->published()->firstWhere('slug', $slug);
    }

    public function all(): Collection
    {
        $files = glob($this->path.'/*.md') ?: [];

        return collect($files)->map(fn (string $file) => $this->parse($file));
    }

    public function parse(string $file): array
    {
        $source = file_get_contents($file);

        if ($source === false || ! preg_match('/\A---\R(.*?)\R---\R(.*)\z/s', $source, $parts)) {
            throw new RuntimeException("Insight [{$file}] must contain YAML-style front matter.");
        }

        $metadata = $this->parseFrontMatter($parts[1], $file);
        $missing = array_diff(self::REQUIRED, array_keys($metadata));

        if ($missing !== []) {
            throw new RuntimeException("Insight [{$file}] is missing required metadata: ".implode(', ', $missing).'.');
        }

        if (! is_string($metadata['slug']) || ! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $metadata['slug'])) {
            throw new RuntimeException("Insight [{$file}] has an invalid slug.");
        }

        if (! in_array($metadata['type'], self::TYPES, true)) {
            throw new RuntimeException("Insight [{$file}] has an unsupported type.");
        }

        try {
            $publishedAt = CarbonImmutable::createFromFormat('!Y-m-d', $metadata['published_at']);
            $updatedAt = isset($metadata['updated_at']) ? CarbonImmutable::createFromFormat('!Y-m-d', $metadata['updated_at']) : null;
        } catch (\Throwable) {
            throw new RuntimeException("Insight [{$file}] has an invalid date; use YYYY-MM-DD.");
        }

        if ($publishedAt === false || (isset($metadata['updated_at']) && $updatedAt === false)) {
            throw new RuntimeException("Insight [{$file}] has an invalid date; use YYYY-MM-DD.");
        }

        return [
            'title' => $metadata['title'],
            'slug' => $metadata['slug'],
            'summary' => $metadata['summary'],
            'published_at' => $publishedAt,
            'updated_at' => $updatedAt,
            'type' => $metadata['type'],
            'type_label' => Str::headline($metadata['type']),
            'tags' => $metadata['tags'] ?? [],
            'draft' => $metadata['draft'] ?? false,
            'html' => Str::markdown(trim($parts[2]), [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]),
        ];
    }

    private function parseFrontMatter(string $source, string $file): array
    {
        $data = [];
        $listKey = null;

        foreach (preg_split('/\R/', $source) as $line) {
            if (preg_match('/^\s+-\s+(.+)$/', $line, $match) && $listKey !== null) {
                $data[$listKey][] = $this->scalar($match[1]);
            } elseif (preg_match('/^([a-z_]+):(?:\s*(.*))$/', $line, $match)) {
                $listKey = $match[2] === '' ? $match[1] : null;
                $data[$match[1]] = $listKey ? [] : $this->scalar($match[2]);
            } elseif (trim($line) !== '') {
                throw new RuntimeException("Insight [{$file}] contains invalid front matter.");
            }
        }

        return $data;
    }

    private function scalar(string $value): string|bool
    {
        $value = trim($value);

        if (in_array($value, ['true', 'false'], true)) {
            return $value === 'true';
        }

        if (strlen($value) >= 2 && in_array($value[0], ['"', "'"], true) && substr($value, -1) === $value[0]) {
            return stripcslashes(substr($value, 1, -1));
        }

        return $value;
    }
}
