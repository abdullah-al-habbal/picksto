# Upload Module

## Purpose

File upload utility for handling image/file storage operations. Provides reusable methods that other modules consume for uploading avatars, logos, favicons, product images, and deleting stored files.

## Key Entities / Relationships

No database tables, no Eloquent models, no migrations.

## API Surface

No REST API. The `UploadRepository` class provides methods called programmatically:

| Method | Purpose | Storage Path |
|--------|---------|-------------|
| `storeLogo(UploadedFile)` | Upload site logo | `public/logos/` |
| `storeFavicon(UploadedFile)` | Upload site favicon | `public/favicons/` |
| `storeProductImage(UploadedFile)` | Upload product image | `public/products/` |
| `storeAvatar(UploadedFile, userId)` | Upload user avatar | `public/avatars/` |
| `deleteFile(folder, filename)` | Delete a file from allowed folders | — |

Allowed folders for deletion: `logos`, `favicons`, `products`, `avatars`, `thumbnails`.

Validation requests:
- `UploadImageRequest` — validates `file` as image, max 5MB (5120 KB)
- `DeleteFileRequest` — validates `folder` (in allowed list) and `filename` (regex for image extensions: jpg/jpeg/png/webp/gif/svg)

## Events / Listeners

None.

## Integration with the Rest of the System

- **Settings module**: `storeLogo()` and `storeFavicon()` update `site_config` JSON in the `settings` table directly
- **User module**: `storeAvatar()` updates the user's `avatar` column in the `users` table directly
- **Product module**: `storeProductImage()` stores images and returns processing info (stub — always returns "original" format with no actual processing)
- **Service Provider**: No migrations or views loaded; only routes and translations (Routes file may not exist, making `loadRoutes()` a no-op)

## Config / Env Varss

Uses Laravel's default `public` disk (configurable via `FILESYSTEM_DISK` env or `config/filesystems.php`).

## Known Quirks / Dependencies

- All files are stored on the `public` disk and served via `/storage/` symlink
- `storeLogo()` and `storeFavicon()` directly query `SettingModel` with a manual `json_decode` fallback for BC compatibility
- `storeProductImage()` has a try-catch that always falls back to the original file if "processing" fails — the catch block sets a generic error but the upload still succeeds
- `deleteFile()` validates allowed folders but does not validate ownership (any authenticated user could delete any file if they know the folder/filename)
- No image resizing, optimization, or thumbnailing is performed
