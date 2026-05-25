# Fix Plan — Picksto Laravel Application

Organised by module and severity. File paths relative to `picksto/`.

---

## Module: Language

### LANG-1 [HIGH] Missing translation files — ✅ DONE
- **Issue**: `modules/Language/lang/` did not exist.
- **Fix**: Created `modules/Language/lang/en/language.php` and `modules/Language/lang/ar/language.php`.

### LANG-2 [LOW] Hardcoded nav group string — ✅ DONE
- **Issue**: `LanguageResource.php` uses `__('Settings')` instead of translatable `__()` key.
- **Fix**: Changed to `__('dashboard.navigation.groups.settings')`.

---

## Module: Package

### PKG-1 [HIGH] Form field names don't match DB columns — ✅ DONE
- **Issue**: Used `duration` and `downloads_per_day` but DB columns are `duration_days` and `daily_limit`. Missing: `monthly_limit`, `allowed_sites`, `currency`, `is_active`.
- **Fix**: Renamed fields, added missing ones.

### PKG-2 [MEDIUM] PackageInfolist missing fields — ✅ DONE (already complete)
- **Issue**: Infolist already includes all fields correctly. No fix needed.

---

## Module: Product

### PROD-1 [HIGH] Form field `image` doesn't match DB column `image_url` — ✅ DONE
- **Fix**: Renamed to `image_url`.

### PROD-2 [MEDIUM] Missing form fields — ✅ DONE
- **Fix**: Added `currency` and `sort_order` fields.

### PROD-3 [LOW] Product lang missing keys — ✅ DONE
- **Fix**: Added `currency`, `sort_order` to lang file.

---

## Module: Referral

### REF-1 [HIGH] ReferralForm contains fields not in `referrals` table — ✅ DONE
- **Fix**: Removed `status`, `earned_at`, `claimed_at`, `expires_at`. Added `registered_at` (DateTimePicker, default now).

### REF-2 [HIGH] ReferralInfolist contains invalid fields — ✅ DONE
- **Fix**: Replaced with `registered_at`, `referrer.name`, `referred.name`, `created_at`.

### REF-3 [LOW] Missing `registered_at` lang key — ✅ DONE
- **Fix**: Added `registered_at` to referral en/ar lang files.

---

## Module: Settings (Admin)

### SET-1 [MEDIUM] SettingForm field `key` doesn't match DB column `key_name` — ✅ DONE
- **Fix**: Changed to `key_name`.

### SET-2 [LOW] SettingForm missing `description` field — ✅ DONE
- **Fix**: Added `description` field to form and infolist.

### SET-3 [LOW] SettingInfolist missing `description` — ✅ DONE
- **Fix**: Added entry.

---

## Module: Settings (Client)

### SETC-1 [HIGH] Client SettingsForm fields don't match UserSettingModel — ✅ DONE
- **Fix**: Renamed to `notify_email_enabled`, `notify_whatsapp_enabled`. Removed non-existent `push_notifications`, `marketing_emails`.

---

## Module: Subscription

### SUB-1 [LOW] SubscriptionForm missing `last_download_date` — ✅ SKIPPED
- **Note**: `last_download_date` is auto-managed by system, not user-editable. Intentional omission.

---

## Module: Download

### DWN-1 [LOW] Missing `item`, `original_url`, `site_source` lang keys — ✅ DONE
- **Fix**: Added missing keys to en/ar lang files.

---

## Module: Currency (Client)

### CURC-1 [MEDIUM] Client CurrencyForm field name mismatch — ✅ SKIPPED
- **Note**: The `CurrencyPage` handles the mapping internally — it saves `currency_id` from the `currency` field. Intentional design.

---

## Root Language

### DASH-1 [MEDIUM] Missing dashboard navigation group translations — ✅ DONE
- **Fix**: Added all 13 group keys to `lang/en/dashboard.php` and created `lang/ar/dashboard.php`.

### DASH-2 [MEDIUM] Missing Arabic dashboard lang file — ✅ DONE
- **Fix**: Created `lang/ar/dashboard.php`.

---

## Module: Verification

### VER-1 [MEDIUM] English lang file incomplete vs Arabic — ✅ DONE
- **Fix**: Added missing `validation`, `messages`, `errors`, `fields`, `types`, `statuses` sections to English file.

---

## Module: Ticket

### TKT-1 [LOW] Lang file asymmetry EN vs AR — ✅ DONE
- **Fix**: Normalised Arabic file to include `priorities`, `fields.message`, `statuses.pending`. Kept `in_progress` as alias.

---

## Environment / Config

### ENV-1 [MEDIUM] Missing browser service env vars in Laravel `.env.example` — ✅ DONE
- **Fix**: Added `BROWSER_SERVICE_URL` and `BROWSER_SERVICE_SECRET` to `.env.example`.

### ENV-2 [LOW] DownloadRepository uses wrong column name — ✅ DONE
- **Issue**: `source_url` in `requestDownload()` should be `original_url`.
- **Fix**: Corrected column name.
