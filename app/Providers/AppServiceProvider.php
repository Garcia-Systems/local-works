<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RuntimeException;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (! $this->app->environment('production')) {
            return;
        }

        $url = config('app.url');
        $intakeEmail = config('services.local_works.intake_email');
        $fromAddress = config('mail.from.address');

        if (blank(config('app.key'))) {
            throw new RuntimeException('Production APP_KEY must be generated and configured.');
        }

        if (config('app.debug')) {
            throw new RuntimeException('Production APP_DEBUG must be false.');
        }

        if (! is_string($url) || filter_var($url, FILTER_VALIDATE_URL) === false || parse_url($url, PHP_URL_SCHEME) !== 'https') {
            throw new RuntimeException('Production APP_URL must be a valid HTTPS URL.');
        }

        if (! is_string($intakeEmail) || filter_var($intakeEmail, FILTER_VALIDATE_EMAIL) === false || str_ends_with($intakeEmail, '@example.com')) {
            throw new RuntimeException('Production LOCAL_WORKS_INTAKE_EMAIL must be a valid monitored address.');
        }

        if (! is_string($fromAddress) || filter_var($fromAddress, FILTER_VALIDATE_EMAIL) === false || str_ends_with($fromAddress, '@example.com')) {
            throw new RuntimeException('Production MAIL_FROM_ADDRESS must be a valid verified sender address.');
        }

        if (in_array(config('mail.default'), ['log', 'array'], true)) {
            throw new RuntimeException('Production MAIL_MAILER must use a real transactional mail transport, not log or array.');
        }

        if (config('database.default') !== 'mysql') {
            throw new RuntimeException('Production DB_CONNECTION must be mysql for the documented Laravel Cloud deployment.');
        }

        if (config('session.driver') !== 'database' || ! config('session.secure')) {
            throw new RuntimeException('Production requires SESSION_DRIVER=database and SESSION_SECURE_COOKIE=true.');
        }

        if (config('cache.default') !== 'database') {
            throw new RuntimeException('Production CACHE_STORE must be database for durable shared caching and throttling.');
        }

        if (config('analytics.enabled') && (config('analytics.provider') !== 'plausible' || blank(config('analytics.site_id')))) {
            throw new RuntimeException('Enabled analytics requires ANALYTICS_PROVIDER=plausible and ANALYTICS_SITE_ID.');
        }
    }
}
