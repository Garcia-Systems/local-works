const provider = document.querySelector('meta[name="analytics-provider"]')?.content;

if (provider === 'plausible') {
    window.plausible = window.plausible || function (...args) {
        (window.plausible.q = window.plausible.q || []).push(args);
    };

    const track = (event, properties = {}) => {
        try {
            window.plausible(event, { props: properties });
        } catch {
            // Analytics is observational. A blocked or unavailable provider must change nothing.
        }
    };

    document.addEventListener('click', (clickEvent) => {
        const target = clickEvent.target instanceof Element
            ? clickEvent.target.closest('[data-analytics-event="audit_cta_click"]')
            : null;

        if (target) track('audit_cta_click', { location: target.dataset.analyticsLocation });
    });

    if (document.querySelector('[data-analytics-page="audit"]')) {
        track('audit_page_view');
    }

    const auditForm = document.querySelector('[data-analytics-form="audit-request"]');
    const meaningfulAuditFields = new Set([
        'name',
        'email',
        'business_name',
        'friction_description',
        'current_process',
    ]);

    if (auditForm) {
        let auditStarted = false;
        const recordAuditStart = (interaction) => {
            if (auditStarted || !meaningfulAuditFields.has(interaction.target.name)) return;

            auditStarted = true;
            track('audit_form_start');
            auditForm.removeEventListener('input', recordAuditStart);
            auditForm.removeEventListener('focusin', recordAuditStart);
        };

        auditForm.addEventListener('input', recordAuditStart);
        auditForm.addEventListener('focusin', recordAuditStart);
    }

    document.querySelectorAll('[data-analytics-success-event]').forEach((marker) => {
        track(marker.dataset.analyticsSuccessEvent);
    });
}
