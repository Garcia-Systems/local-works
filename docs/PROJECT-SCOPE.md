# Version 1 Project Scope

## Decision

Local Works needs more business validation, not a larger software surface. Version 1 is a small public marketing website whose purpose is to turn the right stranger into a real conversation through a Digital Friction Audit request. The objective is the **spark sale**, not feature count.

This decision constrains future architecture until real operating evidence justifies a change.

## Feature gate

Before adding an important feature, ask:

1. What business problem does this solve?
2. Does Version 1 actually need it?
3. Could an existing tool solve it?
4. Has the Operating Lab or a real customer interaction demonstrated the need?
5. Does this help Local Works get closer to the first real sale?

**Do not build a feature merely because it might become useful after Local Works has many customers.**

When the answers are uncertain, prefer no feature, a file-backed content change, or an existing service. Record meaningful new evidence before expanding the architecture.

## Boundaries

- Maintain one conventional Laravel monolith with Blade, Tailwind, and Vite.
- Keep every marketing route public. Do not introduce authentication or role systems.
- Keep marketing content in code/files. Do not add a CMS, admin UI, or content CRUD.
- Add relational persistence only for a demonstrated workflow. `audit_requests` and the minimal `contact_requests` inbound-message record are the only operational entities justified and implemented for Version 1.
- Do not infer customers, accounts, organizations, projects, proposals, invoices, partners, tasks, workflow models, findings, recommendations, solutions, or subscriptions from possible future needs.
- Prefer **Configure → Integrate → Automate → Custom Build → Leave Alone**. “Leave Alone” remains legitimate.
- Do not add React, Vue, Angular, Inertia, Livewire, a separate API, microservices, Redis, Elasticsearch, websockets, or queues without a demonstrated requirement.
- Do not build portals, dashboards, a CRM, project management, proposals, invoicing, payments, chat, tickets, automated recommendations or reports, AI audits, scheduling, calendars, marketplaces, multi-tenancy, subscriptions, or complex permissions.

## Truth and public evidence

Never fabricate Local Works customers, testimonials, logos, case studies, revenue, performance or savings figures, delivery partners, developer networks, customer counts, or operating history. Clearly label hypothetical examples. Until real evidence exists, say so plainly.

## Current implementation checkpoint

The current public shell provides public marketing and session-gated confirmation routes in a shared, mobile-first Blade layout. Its centrally defined Tailwind theme uses a natural green, warm neutral surfaces, charcoal text, a system font stack, consistent spacing, buttons, links, cards, and media-frame styling. Reusable Blade components provide the text-based brand, flexible page introduction, and responsive five-step process sequence. The header includes a small progressive-enhancement menu script with explicit state, Escape-key handling, and focus management; no frontend framework has been introduced.

The homepage, How It Works methodology, Digital Friction Audit service page, Problems, About, and Contact pages are complete. Audit and general-contact intake are the only active operational workflows; all public marketing content remains file-backed. Future photography should use the `.media-frame` presentation primitive, meaningful alt text, and verified real-world imagery; example imagery must never be represented as a Local Works customer.

The Digital Friction Audit submission pipeline remains the primary operational workflow. General Contact is a deliberately smaller secondary intake for inquiries that do not fit an audit request. A dedicated request validates the public form; `audit_requests` stores only contact/business context, workflow descriptions, first-touch attribution, status, and timestamps; and a configurable mail notification follows successful persistence. CSRF, a honeypot, and a five-attempts-per-ten-minutes throttle provide initial abuse protection. The session-gated thank-you page uses Post/Redirect/Get and exposes a PII-free `audit_form_submit` marker.

Attribution retains the initial session landing path and referrer plus the first UTM set observed anywhere in the public journey. Mail failures do not roll back stored requests and are logged by request ID rather than customer content. Production must configure `LOCAL_WORKS_INTAKE_EMAIL` and a working Laravel mail transport. The current privacy policy does not set a numeric retention period; retention should be configured as operating and legal requirements become known rather than inventing one now.

**Audit requests are captured by the production website, but lead management remains outside the custom application until real operating evidence justifies additional tooling.**

General Contact persists name, email, optional phone and business name, message, first-touch attribution, `new` status, and timestamps before sending a notification to the same configured intake recipient. It reuses CSRF, validation, honeypot, throttling, attribution, mail-failure, and truthful session-gated confirmation patterns. It introduces no contact domain service, thread, ticket, public record route, inbox, CRM, or admin interface. **General inbound messages are captured, but lead/customer management remains outside the custom application until real operating evidence justifies additional tooling.** There remains no audit engine, public record route, admin/CRM interface, customer/account/project model, or automated recommendation.

The Insights index and article pages use repository-backed Markdown in `resources/content/insights/`. A small service handles strict metadata parsing, safe Markdown rendering, draft/future-date exclusion, sorting, and slug lookup; there is no article table, CMS, editor, search, newsletter, comments, accounts, or case-study subsystem. Content types state whether a piece is an educational Insight, public Observation, hypothetical Example, or an evidence-backed future Case Study. See `docs/INSIGHTS.md` for publishing and truthfulness rules.

Early-funnel analytics is an optional, disabled-by-default Plausible integration with a small dependency-free browser module. Native page views plus `audit_cta_click`, `audit_page_view`, `audit_form_start`, server-confirmed `audit_form_submit`, and server-confirmed `contact_form_submit` measure movement toward a real request without sending form content or contact/business details. The existing session-based first-touch attribution remains the source-to-request record and is not replaced by aggregate analytics. There is no analytics dashboard, profile, fingerprint, replay, scoring, or marketing-automation subsystem. See `docs/ANALYTICS.md` for configuration, metric definitions, and UTM conventions.
