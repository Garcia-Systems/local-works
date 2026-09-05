# Analytics and early funnel

## Architecture and configuration

Local Works uses one optional provider: **Plausible Analytics**. It supplies native page views for all public routes, including the homepage, How It Works, Digital Friction Audit, Problems, About, Contact, Insights, and individual articles. The provider script is rendered only when all three conditions are true:

```dotenv
ANALYTICS_ENABLED=true
ANALYTICS_PROVIDER=plausible
ANALYTICS_SITE_ID=www.example.com
```

`ANALYTICS_SITE_ID` is the public domain/site identifier configured in Plausible, not a secret. Keep analytics disabled for local development, tests, and previews. The application accepts only the implemented `plausible` provider value; the script URL is fixed in reviewed code rather than supplied through configuration.

Plausible's standard script records native page views. On the audit route the small local module additionally emits `audit_page_view` once per page load as an explicit funnel stage; it is a custom event and should not be added to page-view totals. The module queues events safely if the provider is still loading and does nothing when analytics is disabled. Navigation and both server-rendered forms remain independent of analytics and JavaScript.

This implementation uses Plausible's cookieless measurement and therefore does not add an optional-tracking cookie banner. That describes the technical implementation, not legal advice; deployment requirements should still be reviewed for the jurisdictions served.

## Decision-useful events

1. **Visitor — `page_view`:** provider-native public page view.
2. **Interest — `audit_cta_click`:** an intentional audit link click, with only a stable `location` property.
3. **Evaluation — `audit_page_view`:** arrival on `/digital-friction-audit`.
4. **Intent — `audit_form_start`:** emitted once after focus or input on Name, Email, Business Name, friction description, or current process. Hidden and honeypot fields do not qualify.
5. **Lead — `audit_form_submit`:** emitted only from the one-time, server-confirmed audit thank-you response.

`contact_form_submit` is similarly emitted only from the server-confirmed Contact thank-you response, but Contact is secondary rather than part of the primary audit funnel. No form values or database IDs are event properties.

Useful initial calculations are:

- **Audit CTA rate:** audit CTA clicks divided by relevant visits.
- **Audit page-to-start rate:** audit form starts divided by audit page visits.
- **Audit completion rate:** successful audit submissions divided by audit form starts.
- **Visitor-to-audit rate:** successful audit submissions divided by site visitors.
- **Source-to-audit count:** successful audit records grouped by persisted source and campaign.

Use Plausible reporting for aggregate behavior and the request records for source-to-lead analysis. Do not build a custom dashboard.

## Analytics versus first-touch attribution

The analytics provider reports aggregate site behavior. The existing session-based first-touch attribution separately persists the original landing path, referrer, and first observed set of `utm_source`, `utm_medium`, `utm_campaign`, `utm_content`, and `utm_term` on a successful Audit or Contact record. Later navigation and later UTM parameters do not overwrite that first set. This direct database attribution is what connects acquisition to a real request; analytics does not replace or write to it.

## Small UTM playbook

Use lowercase, readable values. `source` says where the link was sent, `medium` describes the channel, `campaign` names one bounded initiative, and optional `content` distinguishes a meaningful variation. Campaign values are not hard-coded in the application.

- LinkedIn company post: `utm_source=linkedin&utm_medium=social&utm_campaign=launch`
- Direct LinkedIn outreach: `utm_source=linkedin&utm_medium=outreach&utm_campaign=initial_validation`
- Referral: `utm_source=referral&utm_medium=partner_or_contact&utm_campaign=initial_validation`

Consistency matters more than a large taxonomy. Never place personal or sensitive information in UTM values.

## Deliberately deferred

Do not yet measure scroll depth, mouse movement, every link or navigation click, hovers, rage clicks, video behavior, detailed content-engagement scores, lead scores, customer lifetime value, proposals, sales pipeline, support, or portal engagement. There is no session replay, fingerprinting, campaign manager, analytics route, chart, or custom dashboard.
