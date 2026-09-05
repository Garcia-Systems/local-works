<?php

namespace App\Http\Controllers;

use App\Services\InsightContent;
use Illuminate\View\View;

class InsightController extends Controller
{
    public function index(InsightContent $content): View
    {
        return view('pages.insights', ['articles' => $content->published()]);
    }

    public function show(string $slug, InsightContent $content): View
    {
        $article = $content->findPublished($slug);

        abort_unless($article, 404);

        return view('pages.insight', ['article' => $article]);
    }
}
