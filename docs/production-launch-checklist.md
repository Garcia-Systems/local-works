# Production launch checklist

Use this with the README Production Runbook. Record the deployment ID, operator, UTC time, canonical hostname, controlled test label, and last known-good deployment before starting.

## Before deployment

- [ ] Confirm PHP 8.3, Laravel 12 application settings, MySQL 8.4, and the final www/non-www hostname in Laravel Cloud.
- [ ] Point `APP_URL` at that one HTTPS hostname; confirm DNS and the platform certificate are ready.
- [ ] Set `APP_ENV=production`, `APP_DEBUG=false`, a newly generated `APP_KEY`, and no secrets in Git.
- [ ] Attach the durable database and set `DB_URL`, or all six standard MySQL connection values.
- [ ] Enable provider-managed database backups, choose retention, name a restore owner, and record a recently verified restore procedure.
- [ ] Set database sessions/cache, secure cookies, sync queue, stderr logging, and warning-level production logs as specified in the runbook.
- [ ] Configure a real transactional mail transport, verified from identity, monitored intake recipient, and provider-required SPF/DKIM/domain verification.
- [ ] Decide whether analytics launches disabled. If enabled, verify the Plausible site ID matches the canonical hostname.
- [ ] Confirm `composer.lock` and `package-lock.json` are committed and the deployment uses locked production installs.
- [ ] Record the last known-good commit/deployment and confirm an operator can redeploy it.

## Release

- [ ] Production Composer dependencies install successfully without development packages.
- [ ] `npm ci` and the Vite production build succeed, and the deployment serves the versioned assets.
- [ ] Run only `php artisan migrate --force`; confirm all lead, session, and cache migrations applied.
- [ ] Run `php artisan optimize`; do not duplicate its cache steps in the release hook.
- [ ] Confirm no reset, wipe, production seed, automatic rollback, queue worker, or long-running maintenance command is present.
- [ ] `/up` returns the framework's minimal successful health response without diagnostic or secret output.

## Public smoke test

- [ ] Load Home, How It Works, Audit, Problems, About, Insights, one published Insight, Contact, and Privacy over HTTPS.
- [ ] Test desktop navigation, mobile menu/keyboard behavior, and footer links; check current Chromium, Firefox, and Safari/WebKit where available.
- [ ] Confirm canonical and Open Graph URLs use the canonical HTTPS host; inspect `sitemap.xml` and `robots.txt`.
- [ ] Confirm a missing URL returns the branded 404 and no debug/stack/configuration details are visible.
- [ ] Confirm redirects and generated URLs never downgrade HTTPS; inspect the deployed client IP used by a controlled throttle test without trusting custom headers.
- [ ] Confirm session cookies are Secure and HTTP-only with SameSite=Lax and the intended host scope.

## One controlled conversion journey

- [ ] Choose a unique label such as `DEPLOYMENT TEST — YYYY-MM-DD — <deployment-id>`; never impersonate a prospect.
- [ ] Start on a tagged landing URL, click an Audit CTA, load Audit, and begin the form; if enabled, confirm page view, `audit_cta_click`, `audit_page_view`, and `audit_form_start` without PII.
- [ ] Submit one valid Audit; confirm its database record, original attribution, thank-you page, notification delivery, and one `audit_form_submit` event.
- [ ] Submit one valid Contact using the same clear label; confirm durable record, success page, notification, and one `contact_form_submit` event.
- [ ] Submit one invalid request without creating another lead; confirm validation and no false success/conversion event.
- [ ] If cleanup is approved, back up first and remove only records matching the exact controlled label through trusted platform/database tooling.

## Operational handoff

- [ ] Inspect Laravel Cloud application/deployment logs and confirm failures include useful context but no names, emails, phone numbers, messages, or workflow descriptions.
- [ ] Confirm platform health/deployment/database alerts and mail-provider failure signals go to an accountable operator.
- [ ] Confirm new leads can be handled through the monitored inbox and secure database tooling; do not expose lead records publicly.
- [ ] Record the current retention decision/review owner without claiming indefinite storage or enabling speculative deletion.
- [ ] Confirm rollback operators understand that code rollback and database rollback are separate decisions.
- [ ] Confirm no customer upload storage, admin, CRM, portal, queue, Redis, custom backup system, or observability stack was introduced.
