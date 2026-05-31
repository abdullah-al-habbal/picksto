<?php

declare(strict_types=1);

namespace Modules\Website\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Package\Models\PackageModel;
use Modules\Settings\Models\SettingModel;

final class LandingController extends Controller
{
    public function __invoke()
    {
        $packages = PackageModel::query()
            ->active()
            ->orderBy('price')
            ->take(3)
            ->get();

        $settings = $this->getPublicSettings();

        return view('website::landing', compact('packages', 'settings'));
    }

    private function getPublicSettings(): array
    {
        $siteConfig = SettingModel::get('site_config', []);

        return [
            'site_name' => $siteConfig['site_name'] ?? config('app.name'),
            'site_description' => $siteConfig['site_description'] ?? '',
            'logo' => $siteConfig['logo'] ?? null,
            'favicon' => $siteConfig['favicon'] ?? null,
            'contact_email' => SettingModel::get('contact_email', ''),
            'contact_phone' => SettingModel::get('contact_phone', ''),
            'contact_address' => SettingModel::get('contact_address', ''),
            'social_links' => SettingModel::get('social_links', []),
            'features' => SettingModel::get('features', []),
            'hero_title' => SettingModel::get('hero_title', ''),
            'hero_subtitle' => SettingModel::get('hero_subtitle', ''),
        ];
    }
}
