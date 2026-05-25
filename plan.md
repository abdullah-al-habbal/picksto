# Fix Plan — Picksto Laravel Application

Organised by module and severity. File paths relative to `picksto/`.

---

## Module: Language

### LANG-1 [HIGH] Missing translation files
- **Issue**: `modules/Language/lang/` does not exist. The module has no en/ar translation files.
- **Files affected**: `modules/Language/`
- **Fix**: Create `modules/Language/lang/en/language.php` and `modules/Language/lang/ar/language.php` with labels for the model fields (name, code, is_active, is_default, is_rtl).

### LANG-2 [LOW] Hardcoded nav group string
- **Issue**: `modules/Language/Filament/Admin/Resources/LanguageResource.php` uses `->group('Settings')` instead of a translatable `__()` key.
- **Fix**: Replace with `->group(__('dashboard.navigation.groups.settings'))`.

---

## Module: Package

### PKG-1 [HIGH] Form field names don't match DB columns
- **Issue**: `modules/Package/Filament/Admin/Resources/Schemas/PackageForm.php` uses `duration` and `downloads_per_day` but the database columns are `duration_days` and `daily_limit`.
- **Fix**: Rename fields to `duration_days` and `daily_limit`. Also add missing fields: `monthly_limit`, `allowed_sites`, `currency`, `is_active`.

### PKG-2 [MEDIUM] PackageInfolist missing fields
- **Issue**: Infolist doesn't show `currency`, `allowed_sites`, `monthly_limit`, `is_active` (partially shown).
- **Fix**: Add missing entries to the infolist.

---

## Module: Product

### PROD-1 [HIGH] Form field `image` doesn't match DB column `image_url`
- **Issue**: `modules/Product/Filament/Admin/Resources/Schemas/ProductForm.php` uses `image` but the DB column is `image_url`. The fileUpload saves to `image` which won't populate `image_url`.
- **Fix**: Rename field to `image_url` or add mutator on model.

### PROD-2 [MEDIUM] Missing form fields
- **Issue**: Form is missing `currency`, `sort_order` fields which exist in the DB table.
- **Fix**: Add `currency` (Select with currency options) and `sort_order` (TextInput/numeric) fields.

### PROD-3 [LOW] ProductInfolist missing fields
- **Issue**: Infolist doesn't show `currency`, `sort_order`, or `description`.
- **Fix**: Add missing entries to infolist.

---

## Module: Referral

### REF-1 [HIGH] ReferralForm contains fields not in the `referrals` table
- **Issue**: `modules/Referral/Filament/Admin/Resources/Schemas/ReferralForm.php` has `status`, `earned_at`, `claimed_at`, `expires_at` — these columns do NOT exist in the `referrals` table. They belong to `referral_rewards`. Saving will produce SQL errors or silently drop data.
- **Fix**: Remove `status`, `earned_at`, `claimed_at`, `expires_at` from the form. Add `registered_at` (DateTimePicker) which IS a column in `referrals`. The `registered_at` should default to `now()`.

### REF-2 [HIGH] ReferralInfolist contains fields not in the `referrals` table
- **Issue**: Same as REF-1 — `modules/Referral/Filament/Admin/Resources/Schemas/ReferralInfolist.php` references `status`, `earned_at`, `claimed_at`, `expires_at` which don't exist.
- **Fix**: Replace with `registered_at` (dateTime), and keep only `referrer.name`, `referred.name`, `registered_at`, `created_at`.

### REF-3 [LOW] ReferralRewardForm missing `user_id` label
- **Issue**: The reward form has a `user_id` Select but could lack proper localization for certain fields. (Minor — already has labels.)

---

## Module: Settings (Admin)

### SET-1 [MEDIUM] SettingForm field `key` doesn't match DB column `key_name`
- **Issue**: `modules/Settings/Filament/Admin/Resources/Schemas/SettingForm.php` uses `Select::make('key')` but DB column is `key_name` and model fillable is `key_name`. Save will silently fail to persist.
- **Fix**: Change to `Select::make('key_name')` or add model attribute mapping.

### SET-2 [LOW] SettingForm missing `description` field
- **Issue**: The form doesn't include `description` (text), which exists in the DB schema.
- **Fix**: Add Textarea::make('description') to the form.

### SET-3 [LOW] SettingInfolist missing `description`
- **Issue**: Infolist doesn't show `description`.
- **Fix**: Add entry.

---

## Module: Settings (Client)

### SETC-1 [HIGH] Client SettingsForm fields don't match UserSettingModel
- **Issue**: `modules/Settings/Filament/Client/Schemas/SettingsForm.php` uses `email_notifications`, `push_notifications`, `marketing_emails` but `UserSettingModel` fillable has `notify_email_enabled`, `notify_whatsapp_enabled`. There's no `push_notifications` or `marketing_emails` column at all.
- **Fix**: Rename to match model: `notify_email_enabled`, `notify_whatsapp_enabled`. Remove `push_notifications` and `marketing_emails` unless the model is extended.

---

## Module: Subscription

### SUB-1 [LOW] SubscriptionForm missing `last_download_date`
- **Issue**: DB has `last_download_date` column not in form.
- **Fix**: Add field or mark as managed by system (acceptable to omit if auto-managed).

---

## Module: Download

### DWN-1 [LOW] DownloadInfolist references `downloadable.name` but no label
- **Issue**: Uses `download::download.fields.item` key which doesn't exist in lang file.
- **Fix**: Add `'item' => 'Item'` to lang file, or use existing `'user'` pattern.

---

## Module: Currency (Client)

### CURC-1 [MEDIUM] Client CurrencyForm field name mismatch
- **Issue**: `modules/Currency/Filament/Client/Schemas/CurrencyForm.php` uses `currency` but `UserSettingModel` fillable has `currency_id`.
- **Fix**: Either rename to `currency_id` with a `relationship('currency', 'code')` Select, or handle mapping in the CurrencyPage save logic.

---

## Root Language

### DASH-1 [MEDIUM] Missing dashboard navigation group translations
- **Issue**: `lang/en/dashboard.php` only has `sales`, `settings`, `referral` groups. Missing: `user_management`, `subscriptions`, `finance`, `content`, `configurations`, `system`, `support`, `account`, `billing`, `growth`.
- **Fix**: Add all missing group keys to both `lang/en/dashboard.php` and `lang/ar/dashboard.php` (if exists).

### DASH-2 [MEDIUM] Missing `dashboard.php` Arabic lang file
- **Issue**: `lang/ar/dashboard.php` may not exist. The root `lang/` only has `en/dashboard.php`.
- **Fix**: Create `lang/ar/dashboard.php` with Arabic nav group translations.

---

## Module: Verification

### VER-1 [MEDIUM] English lang file incomplete vs Arabic
- **Issue**: `modules/Verification/lang/en/verification.php` only has `labels` and `settings` sections. The Arabic version (`lang/ar/verification.php`) has: `validation`, `messages`, `errors`, `labels`, `fields`, `types`, `statuses`. Many keys used in the code reference these missing sections in English.
- **Fix**: Add `validation`, `messages`, `errors`, `fields`, `types`, `statuses` sections to the English lang file.

---

## Module: Ticket

### TKT-1 [LOW] Lang file asymmetry EN vs AR
- **Issue**: Arabic ticket lang has `statuses.in_progress` but English has `statuses.pending` instead. English has `priorities` section but Arabic doesn't. English has 6 fields, Arabic has 5 (missing `message`).
- **Fix**: Normalise both lang files to have identical key structure.

---

## Environment / Config

### ENV-1 [MEDIUM] Missing browser service env vars in Laravel `.env.example`
- **Issue**: `BROWSER_SERVICE_URL` and `BROWSER_SERVICE_SECRET` are referenced in `config/services.php` but not documented in `.env.example`.
- **Fix**: Add `BROWSER_SERVICE_URL=http://127.0.0.1:4000` and `BROWSER_SERVICE_SECRET=` to `.env.example`.

---

## Summary of fix priorities

| Priority | Count | Modules |
|----------|-------|---------|
| HIGH | 6 | Language, Package, Product, Referral, Settings Client |
| MEDIUM | 5 | Settings Admin, Currency Client, Dashboard, Verification, Ticket |
| LOW | 7 | Package Infolist, Product Infolist, Subscription, Download, Settings Infolist, Language nav, ReferralReward |
