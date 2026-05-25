# Integration — Laravel ↔ Browser Service

## Overview

The `picksto-browser-service` (Node.js, Express + Puppeteer) is an internal microservice that automates file downloads from third-party content providers. The Laravel app (`picksto`) makes HTTP requests to it via Laravel's `Http` facade.

## Configuration

### Laravel (`config/services.php`)

```php
'browser' => [
    'url' => env('BROWSER_SERVICE_URL', 'http://127.0.0.1:4000'),
    'secret' => env('BROWSER_SERVICE_SECRET'),
],
```

### Node.js (`src/config/app.config.js`)

```js
apiSecret: process.env.API_SECRET || "change_this_in_production",
```

### Env vars required

| Laravel `.env` | Node `.env` | Match? |
|----------------|-------------|--------|
| `BROWSER_SERVICE_URL=http://127.0.0.1:4000` | `PORT=4000` | URL in Laravel points to Node port |
| `BROWSER_SERVICE_SECRET=<shared>` | `API_SECRET=<shared>` | **YES** — same value, different names |
| — | `BROWSER_HEADLESS=true` | No Laravel equivalent |
| — | `PROVIDER_EMAIL` | No Laravel equivalent |
| — | `PROVIDER_PASSWORD` | No Laravel equivalent |
| — | `DOWNLOAD_DIR=./downloads` | No Laravel equivalent |

## Authentication

Every request carries an `X-API-Secret` header. The Laravel side reads `config('services.browser.secret')` (from `BROWSER_SERVICE_SECRET` env), and the Node side compares it to `process.env.API_SECRET`.

The secret can also be passed as `?secret=` query param on the Node side (fallback).

## Endpoints consumed

### POST /api/extract-preview

| Aspect | Laravel (consumer) | Node (provider) |
|--------|-------------------|-----------------|
| **File** | `modules/Download/Repositories/DownloadRepository.php:81` | `src/actions/extractPreview.action.js` |
| **Request body** | `{ url }` | `{ url, siteSource? }` |
| **Response** | `{ success, data: { title, description, thumbnail, author } }` | `{ success, data: { title, description, thumbnail, author } }` |
| **Auth header** | `X-API-Secret` | checks against `API_SECRET` |

### POST /api/download

| Aspect | Laravel | Node |
|--------|---------|------|
| **File** | `DownloadRepository.php:42` | `src/actions/requestDownload.action.js` |
| **Request body** | `{ url, siteSource, downloadId }` | `{ url, siteSource, providerConfig? }` |
| **Response** | `{ success, data: { downloadPath, fileName, siteSource, url } }` | `{ success, data: { downloadPath, fileName, siteSource, url } }` |
| **Mismatch** | Laravel sends `downloadId` but Node ignores it | Node doesn't need it — file is returned synchronously |

### POST /api/test-provider

| Aspect | Laravel | Node |
|--------|---------|------|
| **File** | `modules/TestProvider/Repositories/TestProviderRepository.php:30` | `src/actions/testProvider.action.js` |
| **Auth header** | `X-API-Secret` | checks against `API_SECRET` |
| **Timeout** | 300s | — |
| **Notes** | Runs browser in `visible` mode for debugging | |

### POST /api/test-custom-bot

| Aspect | Laravel | Node |
|--------|---------|------|
| **File** | `TestProviderRepository.php:71` | `src/actions/testCustomBot.action.js` |
| **Timeout** | 600s | — |

## Mismatches found

| # | Severity | Issue | Fix |
|---|----------|-------|-----|
| 1 | LOW | `DownloadRepository::requestDownload()` (line 36) sets `source_url` but DB column is `original_url` | Change to `original_url` |
| 2 | LOW | `downloadId` sent from Laravel to Node is never read by Node | Either remove from request body or add logging to Node |
| 3 | MEDIUM | `BROWSER_SERVICE_SECRET` has no default in config — empty string when not set | Already documented in `.env.example` fix (ENV-1) |
| 4 | INFO | Env var names differ (`BROWSER_SERVICE_SECRET` vs `API_SECRET`) — same value, just different names | Document in both CLAUDE.md files |

## File serving flow

The browser service downloads files to its local `downloads/` directory. The Laravel app stores the `download_path` on the `downloads` record. When a user requests a file, the `ServeDownloadFileAction` (in `modules/Download/Http/Actions/`) serves the file via:

```
GET /download/{filename}
```

Defined in `modules/Download/Routes/web.php`. Note: this route assumes the file is available at a shared accessible path or is served through Laravel. Currently there is no mechanism to copy/stream the file from the Node service to Laravel storage — the file remains on the Node service filesystem only.
