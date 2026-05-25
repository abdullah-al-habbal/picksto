# Language Module

## Purpose
Manages available system languages (admin CRUD). Languages are referenced by `UserSettingModel` for per-user locale preference.

## Key Entities / Relationships

### `LanguageModel` (table: `languages`)
| Field | Type | Default | Description |
|-------|------|---------|-------------|
| `name` | string | — | Human-readable language name |
| `code` | string | — | Locale code (e.g., `en`, `ar`) |
| `is_active` | boolean | false | Whether language is available for selection |
| `is_default` | boolean | false | Single language marked as default |
| `is_rtl` | boolean | false | Right-to-left layout flag |

### Scopes / Helpers
- `scopeActive()` — filters active languages.
- `getDefault(): ?self` — returns the language with `is_default = true`.

### Relationships
- Referenced by `UserSettingModel` via `language_id` foreign key.

## API Endpoints
None (no routes file, no API actions).

## Admin Filament

| Resource | Pages |
|----------|-------|
| `LanguageResource` | List, Create, Edit |
| Navigation group: Settings | Icon: `heroicon-o-language` |

**Note:** No View page — only List, Create, and Edit.

## Client Filament
None — languages are managed exclusively from the admin panel.

## Events / Listeners
None.

## Integration with Rest of System
- **User settings:** Users can select a language preference, stored in `UserSettingModel.language_id`.
- Default seeded languages via `LanguageSeeder`:
  - English (`en`) — default, active, LTR
  - Arabic (`ar`) — active, RTL
- Application locale may be driven by the user's selected language at runtime (handled outside this module).

## Config / Env Vars
None.

## Known Quirks / Dependencies
- Simple table with few fields; no translatable columns on the model itself.
- Only one language should be marked as `is_default` (enforced at application level, not DB).
- No validation that a default language exists; `getDefault()` returns `null` if none is set.
- No client-facing Filament page — language selection UI would be handled externally (e.g., in a user settings/profile component).
- No API routes defined; the `loadRoutes()` call in the service provider is a no-op (no `Routes/web.php` exists).
