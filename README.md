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

There are no authenticated or application routes. Public pages are direct named view routes in `routes/web.php`, sharing `resources/views/layouts/public.blade.php`. The deliberately small frontend foundation establishes accessible structure and a few future-facing colors without pretending the final design is complete.

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
| `/contact` | Contact |
| `/privacy` | Privacy |
| `/thank-you` | Submission confirmation (future flow) |

`/up` is Laravel's platform health endpoint. The sitemap contains no login, account, dashboard, admin, or API surface.

## Content and data philosophy

Public marketing content initially belongs in reviewed code/file-backed Blade views—not a database, CMS, or admin interface. A relational database should be used only for demonstrated operational data. The only established future entity is `audit_requests`; it is intentionally **not implemented yet**. A submitted business name will not imply a separate Business domain model.

The solution hierarchy is:

> **Configure → Integrate → Automate → Custom Build → Leave Alone**

“Leave Alone” is a valid recommendation. Existing tools should be configured before custom software is considered.

## Version 1 non-goals

Do not build authentication, customer accounts, customer or admin dashboards, customer or delivery-partner portals, a custom CRM or project-management system, proposal generation, invoicing, payments, internal chat, support tickets, automated solution recommendations, AI-powered audits, automated audit reports, custom appointment scheduling or calendars, a partner marketplace, complex permissions, multi-tenancy, SaaS subscriptions, or speculative APIs.

Do not add public customer reviews, fabricated testimonials, fabricated case studies, fabricated customer logos, fabricated metrics, or fake analytics dashboards. Do not add speculative entities for customers, accounts, organizations, projects, proposals, invoices, partners, tasks, workflow definitions, audit findings, recommendations, solutions, or subscriptions.

## Truthfulness requirement

The website must never invent customers, testimonials, customer logos, case studies, revenue, savings percentages, conversion improvements, delivery partnerships, developer networks, customer counts, or years of Local Works operating history. Hypothetical scenarios are permitted only when clearly labeled as examples. Real evidence must come from real customer interactions.
