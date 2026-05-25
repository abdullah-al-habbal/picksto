# Download Module

## Purpose
Manages file download requests from third-party content sites. Tracks download lifecycle (pending → processing → completed/failed) and serves completed files to users.

## Key Entities / Relationships

### `DownloadModel` (table: `downloads`)
| Field | Type | Description |
|-------|------|-------------|
| `user_id` | FK → users | Requesting user |
| `original_url` | string | Source URL to download from |
| `file_name` | string|null | Resulting filename |
| `site_source` | string | Detected source (Freepik, Flaticon, etc.) |
| `status` | enum | `pending`, `processing`, `completed`, `failed` |
| `download_path` | string|null | Server path to completed file |
| `ip_address` | string|null | Client IP |
| `error_message` | string|null | Failure reason |
| `downloadable_id` | int|null | Polymorphic relation ID |
| `downloadable_type` | string|null | Polymorphic relation type |
| `downloaded_at` | datetime|null | Completion timestamp |

### Polymorphic Relationship (`downloadable`)
- Morph map registered in `DownloadServiceProvider::boot()`:
  - `product` → `Modules\Product\Models\ProductModel`
  - `package` → `Modules\Package\Models\PackageModel`

### Scopes
- `completed()`, `failed()`, `byUser()`, `bySiteSource()`

## API / Routes

| Method | URI | Action | Middleware | Description |
|--------|-----|--------|------------|-------------|
| GET | `/web/downloads/{filename}` | `ServeDownloadFileAction` | `auth` | Serve downloaded file to authenticated user |

### DownloadRepository
- `requestDownload(userId, url)` — calls browser microservice at `POST /api/download` with `X-API-Secret` header
- `extractPreview(url)` — calls browser microservice at `POST /api/extract-preview`
- `detectSiteSource(url)` — maps URL patterns to provider names (Freepik, Flaticon, Envato Elements, MotionArray, Shutterstock, Artlist, Pikbest, Placeit)
- `checkUserEligibility(userId, siteSource)` — validates active subscription, site access, daily limit
- Various `getStats*()` methods used by Analytics module

## Admin Filament

| Resource | Pages |
|----------|-------|
| `DownloadResource` | List, Create, Edit, View |
| Navigation group: Sales | Icon: `heroicon-o-arrow-down-tray` |

## Client Filament

| Page | Description |
|------|-------------|
| `DownloadsPage` | URL input form + download history table |
| Navigation group: Content | Sort order: 3 |

- `RequestDownloadForm` — single URL text input with submit button
- Table shows user's downloads scoped to `auth()->id()`

## Events / Listeners
None defined within the module.

## Integration with Rest of System
- **Browser Service:** Requires `picksto-browser-service` running at `BROWSER_SERVICE_URL` with `BROWSER_SERVICE_SECRET` for authentication.
- **Subscription module:** `checkUserEligibility()` validates against `SubscriptionModel` (active status, package `allowed_sites`, `daily_limit`).
- **Package/Product modules:** Polymorphic `downloadable` relation ties downloads back to products or packages.
- **Analytics module:** Stats methods (`countCompletedToday()`, `getStatsForDate()`, `getStatsForMonth()`, `getStatsByProvider()`, `getTotalStats()`) power dashboard widgets.
- **Morph map** is registered in `DownloadServiceProvider`.

## Config / Env Vars

| Key | Default | Description |
|-----|---------|-------------|
| `BROWSER_SERVICE_URL` | `http://127.0.0.1:4000` | Browser microservice base URL |
| `BROWSER_SERVICE_SECRET` | — | Shared secret for API auth |

## Known Quirks / Dependencies
- Browser microservice may operate asynchronously — the download request checks for immediate completion but may stay in `pending`.
- `detectSiteSource()` is URL-based string matching; order of checks matters (Envato check covers both `envato` and `elements.envato`).
- `ServeDownloadFileAction` sanitizes `$filename` with `basename()` and blocks path traversal (`..` or leading `.`).
- File access: Own downloads for regular users; admins can access any file via the same route.
- Files are served from `local` storage disk.
- The `RequestDownloadRequest` and `PreviewDownloadRequest` validate `url` as a valid URL (max 2048 chars).
- Download table migration uses `DATE_FORMAT` (MySQL) in `getStatsForMonth()` — may need adjustment for non-MySQL databases.
