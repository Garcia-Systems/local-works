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
- Add relational persistence only for a demonstrated workflow. `audit_requests` is the only anticipated operational entity and belongs to a later, explicitly scoped change.
- Do not infer customers, accounts, organizations, projects, proposals, invoices, partners, tasks, workflow models, findings, recommendations, solutions, or subscriptions from possible future needs.
- Prefer **Configure → Integrate → Automate → Custom Build → Leave Alone**. “Leave Alone” remains legitimate.
- Do not add React, Vue, Angular, Inertia, Livewire, a separate API, microservices, Redis, Elasticsearch, websockets, or queues without a demonstrated requirement.
- Do not build portals, dashboards, a CRM, project management, proposals, invoicing, payments, chat, tickets, automated recommendations or reports, AI audits, scheduling, calendars, marketplaces, multi-tenancy, subscriptions, or complex permissions.

## Truth and public evidence

Never fabricate Local Works customers, testimonials, logos, case studies, revenue, performance or savings figures, delivery partners, developer networks, customer counts, or operating history. Clearly label hypothetical examples. Until real evidence exists, say so plainly.

## Current implementation checkpoint

The current public shell provides nine named view routes and a shared, mobile-first Blade layout. Its centrally defined Tailwind theme uses a natural green, warm neutral surfaces, charcoal text, a system font stack, consistent spacing, buttons, links, cards, and media-frame styling. Reusable Blade components provide the text-based brand, flexible page introduction, and responsive five-step process sequence. The header includes a small progressive-enhancement menu script with explicit state, Escape-key handling, and focus management; no frontend framework has been introduced.

The pages remain intentionally brief. The homepage is only a simple hero and positioning line, the Digital Friction Audit does not yet have a form, and contact details are not invented. Public content remains file-backed. Future photography should use the `.media-frame` presentation primitive, meaningful alt text, and verified real-world imagery; example imagery must never be represented as a Local Works customer.

The next appropriate product increment is the explicitly scoped full homepage—not additional application architecture. The later Digital Friction Audit request flow will require explicit data-minimization, validation, spam prevention, notification, privacy, and retention decisions. It must not become an audit engine or customer account system.
