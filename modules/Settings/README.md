<!-- filePath: /home/lenovo/work/projects/the_picksto/picksto/modules/Settings/README.md -->
# Settings Module

## Purpose

Global key-value configuration store for the application. Manages site-wide settings (logo, favicon, site name, download providers) and per-user notification preferences.

## Key Entities / Relationships

| Table | Model | Key Columns | Notes |
|-------|-------|-------------|-------|
| `settings` | `SettingModel` | `key_name` (unique), `value` (JSON), `group`, `description` | Static `get()`/`set()` helpers for quick access |

Key setting entries (stored with `key_name`):
- `site_config` — JSON object with `site_name`, `site_description`, `logo`, `favicon`, `botBrowserVisible`, `downloadProviders[]`

Per-user notification preferences are stored in the **User module** table `user_settings` (`notify_email_enabled`, `notify_whatsapp_enabled`) but updated through `SettingsRepository`.

## API Endpoints

No dedicated REST API. Admin CRUD via Filament `SettingResource`, client notification settings via `SettingsPage`.

## Events / Listeners

None.

## Integration with the Rest of the System

- **Upload module**: Logo/favicon uploads update site_config via this module's SettingModel
- **User module**: User notification preferences are part of UserSettingModel but managed here
- **SettingsRepository::getSettings()** strips `downloadProviders` from non-admin responses
- **TestProvider module**: Reads provider config from site_config settings
- Admin `SettingResource` provides full CRUD; client `SettingsPage` (Filament) provides notification toggles

## Config / Env Vars

No dedicated env vars. All settings are stored in the `settings` database table.

## Known Quirks / Dependencies

- `SettingModel::get()`/`set()` are static convenience methods that query directly — no caching layer
- `SettingsRepository::updateSettings()` uses `site_config` as a monolithic JSON blob: partial updates merge with existing values
- The `downloadProviders` key in site_config is sensitive and filtered out for non-admin users
- Seed data via `SettingsSeeder`
