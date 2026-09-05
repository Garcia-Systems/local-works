# Local Works by Garcia Systems

**Make your business easier to use.**

Local Works helps businesses identify frustrating customer and employee workflows and find the simplest practical way to improve them. **Local Works** is the customer-facing initiative; **Garcia Systems** is its parent, legal, and professional company.

This repository is the production website—not a speculative SaaS product. Version 1 has one objective: **turn the right stranger into a real conversation**. Its primary conversion is **Visitor → Digital Friction Audit request**. The measure of progress is the **spark sale**, not feature count.

## Strategic progression

**Operating Simulation — COMPLETE**

↓

**Small credible Local Works website**

↓

**Real Digital Friction Audits**

↓

**Real conversations**

↓

**First proposal**

↓

**First customer**

↓

**Observe real operations**

↓

**Configure existing tools**

↓

**Automate repeated pain**

↓

**Build custom Local Works software only when justified**

The Operating Lab concluded: **MORE BUSINESS VALIDATION FIRST.** See [`docs/PROJECT-SCOPE.md`](docs/PROJECT-SCOPE.md) before proposing an important feature.

## Technology and architecture

- PHP 8.3+ and Laravel 12
- Server-rendered Blade templates
- Tailwind CSS 4 and Vite
- PHPUnit using SQLite in memory
- SQLite for simple local development; MySQL-compatible configuration for production
- A conventional stateless Laravel monolith suitable for Laravel Cloud

There are no authenticated routes or private application interfaces. Public pages, the audit intake, and lightweight general-contact intake use conventional web routes in `routes/web.php`, sharing `resources/views/layouts/public.blade.php`. Local Works design tokens and presentation primitives live in `resources/css/app.css`; small, repeated Blade patterns live in `resources/views/components`. The only custom browser behavior is the dependency-free mobile navigation in `resources/js/app.js`.

## Local setup

Requirements: PHP 8.3+, Composer, Node.js/npm, and the PHP extensions required by Laravel.

```bash
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
npm install
npm run build
php artisan serve
```

Alternatively, after cloning, `composer run setup` performs dependency installation and setup. Local defaults use SQLite, file sessions/cache, and synchronous work; no Redis or queue worker is required. Production can use MySQL by setting `DB_CONNECTION=mysql` and the standard `DB_*` variables, or a platform-provided `DB_URL`. Secrets and environment-specific settings belong in environment variables, which supports Laravel Cloud deployment.

Set `LOCAL_WORKS_INTAKE_EMAIL` to the monitored address that should receive Digital Friction Audit and general-contact notifications, and configure Laravel's standard `MAIL_*` settings for the production mail transport. The request is committed to the database before mail is attempted. A mail transport failure is logged with only the request ID and does not discard the request or show the visitor a false failure.

Optional, privacy-conscious funnel measurement uses a single configurable Plausible Analytics integration and is disabled by default. See [`docs/ANALYTICS.md`](docs/ANALYTICS.md) for production configuration, events, the analytics-versus-persisted-attribution distinction, and the small owner-facing UTM playbook.

## Quality checks

```bash
composer test
./vendor/bin/pint --test
npm run build
php artisan route:list
```

The feature suite boots the application and visits every public page as a guest, guarding against accidental authentication requirements.

## Public sitemap

| Route | Purpose |
| --- | --- |
| `/` | Home |
| `/how-it-works` | How It Works |
| `/digital-friction-audit` | Digital Friction Audit |
| `/problems` | Problems We Investigate |
| `/about` | About |
| `/insights` | Insights |
| `/insights/{slug}` | A published, file-backed Insights article |
| `/contact` | General Contact |
| `/contact/thank-you` | Session-gated general-contact confirmation |
| `/privacy` | Privacy |
| `/thank-you` | Session-gated audit submission confirmation |

`/up` is Laravel's platform health endpoint. The sitemap contains no login, account, dashboard, admin, or API surface.

## Content and data philosophy

Public marketing content belongs in reviewed code/file-backed Blade views—not a database, CMS, or admin interface. The two deliberately small operational records are `audit_requests` and `contact_requests`. Audit intake stores contact and business context, the described workflow, optional improvement/context, minimal first-touch attribution, a simple lifecycle status, and timestamps. A submitted business name does not imply a separate Business domain model.

First-touch attribution is session-based and intentionally small: the original landing path and referrer are retained, and the first observed `utm_source`, `utm_medium`, `utm_campaign`, `utm_content`, and `utm_term` set is not overwritten during later navigation. No fingerprint or form content is copied into analytics. Intake uses CSRF protection, server validation, a hidden honeypot, and a five-attempts-per-ten-minutes throttle. The `/thank-you` success message requires the one-time post-submission session state; direct access returns to the audit page.

General contact stores name, email, optional phone and business name, message, the same first-touch attribution fields, a `new` status, and timestamps. It notifies the same configured intake recipient after persistence. Mail failure is logged by record ID without discarding the message. CSRF, validation, honeypot, throttle, and session-gated Post/Redirect/Get confirmation follow the audit pattern. There is no public contact-request listing, custom inbox, CRM, or admin interface.

**Audit requests are captured by the production website, but lead management remains outside the custom application until real operating evidence justifies additional tooling.**

**General inbound messages are captured, but lead/customer management remains outside the custom application until real operating evidence justifies additional tooling.** Requests can be reviewed through existing operational tools or direct database access; there is intentionally no admin, CRM, account, or status-management interface.

Insights articles are reviewed Markdown files in `resources/content/insights/`, not database records. The small loader excludes drafts and future-dated articles, validates required metadata, and renders Markdown with raw HTML and unsafe links disabled. See [`docs/INSIGHTS.md`](docs/INSIGHTS.md) for metadata, publishing, evidence-label, observation, and future case-study rules.

The solution hierarchy is:

> **Configure → Integrate → Automate → Custom Build → Leave Alone**

“Leave Alone” is a valid recommendation. Existing tools should be configured before custom software is considered.

## Version 1 non-goals

Do not build authentication, customer accounts, customer or admin dashboards, customer or delivery-partner portals, a custom CRM or project-management system, proposal generation, invoicing, payments, internal chat, support tickets, automated solution recommendations, AI-powered audits, automated audit reports, custom appointment scheduling or calendars, a partner marketplace, complex permissions, multi-tenancy, SaaS subscriptions, or speculative APIs.

Do not add public customer reviews, fabricated testimonials, fabricated case studies, fabricated customer logos, fabricated metrics, or fake analytics dashboards. Do not add speculative entities for customers, accounts, organizations, projects, proposals, invoices, partners, tasks, workflow definitions, audit findings, recommendations, solutions, or subscriptions.

## Truthfulness requirement

The website must never invent customers, testimonials, customer logos, case studies, revenue, savings percentages, conversion improvements, delivery partnerships, developer networks, customer counts, or years of Local Works operating history. Hypothetical scenarios are permitted only when clearly labeled as examples. Real evidence must come from real customer interactions.

## Production quality and launch requirements

The intended production surface is deliberately small: the public routes in the table above, the published file-backed Insight routes, `robots.txt`, `sitemap.xml`, the two form POST endpoints, and Laravel's `/up` health check. There is no authentication, admin area, CRM, CMS, customer portal, lead-record API, or public record view. Keep it that way unless real operating evidence changes the Version 1 scope.

Both forms use Laravel CSRF protection, explicit server-side type and length validation, an off-screen honeypot, and a five-submissions-per-ten-minutes per-client throttle. A valid request is persisted before a synchronous email notification is attempted; notification failures log only the record identifier. Confirmation routes use one-time session state and are marked `noindex`. First-touch landing path, referrer, and the first UTM set are held in the session and copied to a successfully stored request without overwriting later in the visit. Do not put personal data in UTM values.

Published Insights remain reviewed Markdown files; drafts and future-dated files are excluded from article routes and the generated sitemap. The parser strips raw HTML and blocks unsafe links. See `docs/INSIGHTS.md` before publishing and preserve its evidence-label rules.

Before launch, configure at least:

- `APP_ENV=production`, `APP_DEBUG=false`, a generated `APP_KEY`, and the one canonical HTTPS `APP_URL` (used by canonical links, structured data, robots, and the sitemap).
- A durable production database and backups through `DB_URL` or the standard `DB_*` variables; run `php artisan migrate --force` during release.
- A working `MAIL_MAILER` transport, `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME`, and monitored `LOCAL_WORKS_INTAKE_EMAIL`. Do not leave the production mailer as `log`.
- A durable `SESSION_DRIVER` and `CACHE_STORE` appropriate to the platform. Set `SESSION_SECURE_COOKIE=true` when HTTPS is terminated at the deployment platform, and configure trusted proxies there correctly.
- Production log destination and level (normally `LOG_LEVEL=warning` or as operations require). Never add form payloads or contact fields to logs.
- Optional Plausible values described in `docs/ANALYTICS.md`. Analytics is disabled by default, uses no form content, and must never block the site.

The site sends modest browser security headers (`nosniff`, deny framing, a strict-origin referrer policy, and a restricted permissions policy). HTTPS and HSTS should be enforced by the deployment platform after HTTPS behavior is verified. The privacy page describes the implementation but is not a substitute for jurisdiction-specific legal review or an operational retention policy.

Launch checks:

```bash
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction
COMPOSER_ALLOW_SUPERUSER=1 composer test
./vendor/bin/pint --test
npm ci
npm run build
php artisan route:list
COMPOSER_ALLOW_SUPERUSER=1 composer audit
npm audit --omit=dev
```

Also manually check keyboard operation, focus, forms and mobile layout in current Chromium, Firefox, and Safari/WebKit; submit both forms against the production mail transport; inspect the rendered 404/419/429/500 pages; and verify the canonical host, `robots.txt`, sitemap, analytics network request (if enabled), and absence of browser console errors.

## Production Runbook

This runbook targets Laravel Cloud, PHP 8.3, MySQL 8.4, and Vite assets. Laravel Cloud's current build/deploy interface is the authority if its defaults change. Version 1 needs a Laravel web environment, a durable MySQL database, a transactional email provider, and optionally a Plausible site. It needs no worker, Redis service, persistent customer-file disk, or production seeding.

### Required configuration

| Area | Production values |
| --- | --- |
| Application | `APP_NAME`, `APP_ENV=production`, generated `APP_KEY`, `APP_DEBUG=false`, canonical HTTPS `APP_URL` |
| Database | Either platform `DB_URL`, or `DB_CONNECTION=mysql`, `DB_HOST`, `DB_PORT=3306`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` |
| Mail | `MAIL_MAILER` (normally `smtp`), provider `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_SCHEME`, verified `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME="Local Works by Garcia Systems"`, monitored `LOCAL_WORKS_INTAKE_EMAIL` |
| Session | `SESSION_DRIVER=database`, `SESSION_LIFETIME`, `SESSION_SECURE_COOKIE=true`; leave `SESSION_DOMAIN` empty unless the cookie must span known subdomains |
| Cache | `CACHE_STORE=database`; this durable shared store also supports the public-form rate limiter without Redis |
| Logging | `LOG_CHANNEL=stderr`, `LOG_LEVEL=warning` so Laravel Cloud can collect process output |
| Analytics | Keep `ANALYTICS_ENABLED=false`, or set it to `true` with `ANALYTICS_PROVIDER=plausible` and the public `ANALYTICS_SITE_ID` |
| Runtime | `QUEUE_CONNECTION=sync`; no queue worker is required. `FILESYSTEM_DISK=local` may remain local because Version 1 has no uploads or generated customer files. |

Production startup fails with a clear message if the key/debug, HTTPS URL, MySQL, mail, database session/cache, secure-cookie, or enabled analytics settings are unsafe or incomplete. Set every secret in Laravel Cloud, never in Git. The final hostname and www/non-www choice are external launch decisions; `APP_URL` must exactly match that choice. Do not add speculative redirects.

Laravel's normal forwarded-header handling should be used behind Laravel Cloud; do not parse forwarding headers or trust user-selected headers in application code. Confirm generated URLs, request scheme, and throttling client IPs in the deployed environment. Terminate HTTPS at the platform, test it, then enable platform HSTS. `SESSION_SECURE_COOKIE=true`, Laravel's HTTP-only session cookie, and SameSite=Lax are the intended settings.

### Deploy

1. Create the Laravel Cloud application/environment and MySQL 8.4 database; attach the database and configure all environment values above before booting production code.
2. Use reproducible installs: `composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader` and `npm ci && npm run build`. Commit both dependency lockfiles before launch.
3. Use one release command: `php artisan migrate --force && php artisan optimize`. In Laravel 12, `optimize` prepares the framework's configuration, events, routes, and views; separate cache commands are diagnostic checks, not additional release steps.
4. Never run `migrate:fresh`, `db:wipe`, `db:seed`, destructive seeders, or an automatic `migrate:rollback` in production. No production seed data is required.
5. Request `/up`, then work through [`docs/production-launch-checklist.md`](docs/production-launch-checklist.md). Standard Laravel Cloud deployment is proportionate for the initial low-volume site; justify more elaborate strategies only from actual traffic or business risk.

The checked-in migrations are self-contained and create both lead tables plus the framework database session/cache tables. They are compatible with SQLite tests and MySQL. Lead-table status and timestamps are intentionally not additionally indexed: Version 1 has no in-app listing/query workflow and the tables will be small. Add indexes only when a real query requires them. Database sessions expire according to `SESSION_LIFETIME`; Laravel's normal session lottery performs probabilistic cleanup.

### Verify and operate

Use exactly one clearly labeled controlled launch identity (for example, business name `DEPLOYMENT TEST — YYYY-MM-DD`) to submit one Audit and one Contact request. Confirm each stored record, synchronous notification, success page, first-touch attribution, and server-confirmed analytics conversion. Do not send tests to prospects. If cleanup is required, identify records by the unique label and remove only those records with trusted database/platform tooling after taking appropriate care.

The mail provider is not selected or configured by this repository. Complete its sender/domain verification and provider-directed SPF/DKIM DNS work, then verify delivery through provider logs and the monitored inbox. Mail happens after persistence; a failure keeps the lead and writes only record ID, route, and exception class to application logs. Inspect leads initially through notification email and secure database tooling. **If manually managing leads becomes painful, configure an existing CRM before building one.**

Use Laravel Cloud health/deployment/database signals, application stderr logs, mail-provider delivery status, and Plausible (when enabled) as the intentionally small observability set. Configure platform/provider alerts for deployment, application, database, and mail failures. Do not log form payloads or contact details. Establish a documented lead-retention policy as real operational and legal requirements become known; do not automatically delete or assume indefinite retention is correct.

### Back up and recover

Enable provider-managed backups for the production MySQL database before accepting leads. Choose retention appropriate to operational/legal needs, record who can restore, and periodically prove restoration in a non-production environment.

For recovery: identify the failure; stop further harmful changes if needed; select a known-good provider backup; restore it using protected hosting tooling; redeploy known-good code if necessary; run only migrations appropriate to that code/schema state; verify Audit and Contact records; then smoke-test both forms. Never expose restoration through the website.

### Roll back

Identify and redeploy the last known-good commit through Laravel Cloud. **Code rollback and database rollback are different decisions.** Review every migration applied by the failed release. After an additive migration, leaving the added schema while reverting code is usually safer than rolling schema back. Never reflexively run `migrate:rollback` against real lead data; make a backup and approve any schema reversal separately.

### Intentionally absent

There is no admin dashboard, CRM, account or customer portal, queue/worker, upload store, custom backup service, or custom observability/alerting stack. Marketing and Insight content is deployed from Git. These omissions preserve the documented Version 1 scope.

## Version 1 build status

The final launch examination is complete, but Version 1 is **not yet declared build-complete** because this checkout does not contain `composer.lock`. A production lockfile must be generated with Composer against the reviewed dependency constraints, committed, and then used to complete the clean-install test. Do not deploy from an unlocked Composer dependency resolution.

Once that reproducibility blocker is resolved and the documented checks pass, the website provides the public infrastructure needed to begin real-world validation. The next phase is to deploy, verify production configuration, perform a controlled smoke test, begin outreach, perform real Digital Friction Audits, hold discovery conversations, pursue the first proposal and customer, and observe operational friction before building more internal software.

**Additional custom software should be justified by real operating evidence.**
