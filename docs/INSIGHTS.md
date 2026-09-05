# Insights publishing

Insights is a deliberately small, file-backed section of the public Laravel site. It explains Local Works thinking and supports useful outreach; it is not a CMS or a claim that Local Works operates a newsroom.

## Architecture

Markdown files live in `resources/content/insights/`. `App\Services\InsightContent` discovers them, validates front matter, safely renders the body, removes drafts and future-dated pieces from public results, sorts published pieces newest first, and looks up public articles by slug. `InsightController` passes those results directly to the two Blade views. Articles do not use the database.

Supported front matter is intentionally limited:

```yaml
---
title: "A clear title"
slug: "a-clean-url-slug"
summary: "A concise page description and index deck."
published_at: "2026-09-05"
updated_at: "2026-09-06" # optional
type: "insight"
tags:
  - "staff workflow"
draft: true
---
```

Required fields are `title`, `slug`, `summary`, `published_at`, and `type`. Dates use `YYYY-MM-DD`. Supported types are `insight`, `observation`, `example`, and `case-study`. `updated_at`, display-only `tags`, and `draft` are optional. Malformed files fail clearly rather than silently publishing ambiguous content.

Set `draft: true` while a piece is unfinished. Drafts and future `published_at` dates are excluded from both the index and slug route, which returns 404. This is the whole editorial workflow; there is no draft database or approval application.

## Publishing workflow

1. Create a `.md` file in `resources/content/insights/`.
2. Add the small front matter block and use a unique clean slug.
3. Write and review the Markdown article. Raw HTML is not a supported authoring feature.
4. Leave `draft: true` until the content, evidence label, links, and rendered layout have been reviewed.
5. Remove `draft: true`, use an honest publication date, commit, and deploy.

No database change, controller edit, or web editor is needed to publish another article.

## Truthfulness and evidence labels

- **Insight** is general educational content or business-system thinking. It does not imply customer evidence.
- **Observation** records a public or general workflow observation without claiming access to internal operations.
- **Example** is a hypothetical scenario for education and must say clearly that it is hypothetical.
- **Case Study** is reserved for real customer work. Supporting the label in front matter is not permission to use it.

A public observation may state an observable fact—for example, “Observed publicly: the website instructs customers to call to make this change.” It must not infer call volume, staff time, customer sentiment, system capability, or profitability. Write and investigate in this order:

> **Observed fact → Possible friction → Unknowns → Questions → Evidence → Decision**

Do not publish a Case Study until the customer is real, permission exists, every claim is supportable, outcomes are measured appropriately, and confidential details are handled correctly. A qualifying future case study can use this same article format; it does not need a subsystem.

## Explicit non-goals

Version 1 has no CMS, article database, admin editor, comments, reactions, newsletter platform, search engine, user accounts, tag taxonomy management, recommendations, or reading-history tracking. Real content volume and operating evidence—not hypothetical future need—must justify any expansion.
