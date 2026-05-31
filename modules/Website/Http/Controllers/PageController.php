<?php

declare(strict_types=1);

namespace Modules\Website\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Website\Models\WebsitePageModel;

final class PageController extends Controller
{
    public function show(WebsitePageModel $page)
    {
        if (!$page->is_active) {
            abort(404);
        }

        return view('website::page', compact('page'));
    }
}
