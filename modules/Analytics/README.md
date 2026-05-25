# Analytics Module

## Purpose
Provides real-time admin dashboard widgets showing aggregate platform statistics. No models, migrations, or routes — purely presentation-layer widgets registered directly in `AdminPanelProvider`.

## Key Entities / Relationships
- **No Eloquent models.** Data is pulled from `UserRepository`, `SubscriptionRepository`, and `DownloadRepository` (modules: User, Subscription, Download).
- **Services:** `DashboardStatsService` — single entry point for all stats queries.
- **Presenters:** `AnalyticsPresenter` — transforms raw stats into view-friendly arrays.

## Filament Widgets (Admin Panel)

| Widget | Type | Description |
|--------|------|-------------|
| `StatsOverview` | StatsOverviewWidget | Total Users, Active Subscriptions, Downloads Today, Estimated Revenue. 30s polling. |
| `RevenueTrendChart` | ChartWidget (line) | 30-day revenue trend. 30s polling. |
| `PackagePerformanceWidget` | ChartWidget (doughnut) | Subscription distribution by package. |
| `DownloadStatsOverview` | StatsOverviewWidget | Today/month/total completed downloads. 30s polling. |
| `DownloadStatsByProviderTable` | TableWidget | Download counts grouped by site source. |

## API Endpoints
None. Stats are rendered server-side inside Filament widgets.

## Events / Listeners
None.

## Integration with Rest of System
- Depends on `User`, `Subscription`, and `Download` modules for data.
- Widgets are explicitly registered in `app/Providers/Filament/AdminPanelProvider.php` (not auto-discovered).
- Uses `Cache` facade with TTLs: overview (15 min), revenue trend (1 hour), download stats (30 min).

## Config / Env Vars
None.

## Known Quirks / Dependencies
- **No migrations or routes** — service provider only loads translations and views (both optional).
- `trafficSources`, `topCountries`, and `dailyVisits` in `getOverviewStats()` return hardcoded placeholder data.
- `DownloadStatsByProviderTable` uses a dummy query (`whereNull('id')`) — records are injected via `getTableRecords()` override.
- All cache keys prefixed with `dashboard.*`.
- Requires `SubscriptionRepository::getPackagePerformance()`, `getRevenueByDay()`, `getTotalActiveRevenue()` and `DownloadRepository::getStatsForDate()`, `getStatsForMonth()`, `getTotalStats()`, `getStatsByProvider()` to return real data.
