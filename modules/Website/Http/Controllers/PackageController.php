<?php

declare(strict_types=1);

namespace Modules\Website\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Package\Models\PackageModel;

final class PackageController extends Controller
{
    public function index()
    {
        $query = PackageModel::query()->active();

        if ($sort = request('sort')) {
            match ($sort) {
                'price_low' => $query->orderBy('price'),
                'price_high' => $query->orderBy('price', 'desc'),
                default => null,
            };
        } else {
            $query->orderBy('price');
        }

        if ($site = request('site')) {
            $query->where(function ($q) use ($site): void {
                $q->whereJsonContains('allowed_sites', 'All')
                    ->orWhereJsonContains('allowed_sites', $site);
            });
        }

        $packages = $query->paginate(12)->withQueryString();

        $allSites = PackageModel::query()
            ->active()
            ->pluck('allowed_sites')
            ->flatten()
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        return view('website::packages.index', compact('packages', 'allSites'));
    }

    public function show(PackageModel $package)
    {
        if (!$package->is_active) {
            abort(404);
        }

        return view('website::packages.show', compact('package'));
    }
}
