<?php

use App\Http\Controllers\AuditRequestController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\InsightController;
use App\Services\InsightContent;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/how-it-works', 'pages.how-it-works')->name('how-it-works');
Route::view('/digital-friction-audit', 'pages.digital-friction-audit')->name('digital-friction-audit');
Route::post('/digital-friction-audit', [AuditRequestController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('audit-requests.store');
Route::view('/problems', 'pages.problems')->name('problems');
Route::view('/about', 'pages.about')->name('about');
Route::get('/insights', [InsightController::class, 'index'])->name('insights');
Route::get('/insights/{slug}', [InsightController::class, 'show'])->name('insights.show');
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactRequestController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('contact-requests.store');
Route::get('/contact/thank-you', function () {
    return session('contact_submitted')
        ? view('pages.contact-thank-you')
        : redirect()->route('contact');
})->name('contact.thank-you');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::get('/thank-you', function () {
    return session('audit_submitted')
        ? view('pages.thank-you')
        : redirect()->route('digital-friction-audit');
})->name('thank-you');

Route::get('/sitemap.xml', function (InsightContent $content) {
    $routes = collect(['home', 'how-it-works', 'digital-friction-audit', 'problems', 'about', 'insights', 'contact', 'privacy'])
        ->map(fn (string $name): array => ['url' => route($name), 'lastmod' => null]);
    $articles = $content->published()->map(fn (array $article): array => [
        'url' => route('insights.show', $article['slug']),
        'lastmod' => ($article['updated_at'] ?? $article['published_at'])->toDateString(),
    ]);

    return response()->view('sitemap', ['entries' => $routes->concat($articles)])
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::get('/robots.txt', fn () => response(
    "User-agent: *\nAllow: /\nDisallow: /up\n\nSitemap: ".route('sitemap')."\n",
    200,
    ['Content-Type' => 'text/plain; charset=UTF-8'],
))->name('robots');
