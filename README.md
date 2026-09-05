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
