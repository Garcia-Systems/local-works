<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaptureFirstTouchAttribution
{
    private const UTM_KEYS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('first_touch')) {
            $request->session()->put('first_touch', [
                'landing_page' => mb_substr('/'.ltrim($request->path(), '/'), 0, 2048),
                'referrer' => $request->headers->get('referer')
                    ? mb_substr($request->headers->get('referer'), 0, 2048)
                    : null,
                'utms_captured' => false,
            ]);
        }

        $attribution = $request->session()->get('first_touch');
        $hasUtm = collect(self::UTM_KEYS)->contains(fn (string $key): bool => $request->filled($key));

        if (! $attribution['utms_captured'] && $hasUtm) {
            foreach (self::UTM_KEYS as $key) {
                $attribution[$key] = $request->filled($key)
                    ? mb_substr((string) $request->query($key), 0, 255)
                    : null;
            }

            $attribution['utms_captured'] = true;
            $request->session()->put('first_touch', $attribution);
        }

        return $next($request);
    }
}
