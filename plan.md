# Fix Plan — Picksto Laravel Application

Organised by module and severity. File paths relative to `picksto/`.

---

## Module: Language

### LANG-1 [HIGH] Missing translation files — ✅ DONE
- **Fix**: Created `modules/Language/lang/en/language.php` and `modules/Language/lang/ar/language.php`.

### LANG-2 [LOW] Hardcoded nav group string — ✅ DONE
- **Fix**: Changed to `__('dashboard.navigation.groups.settings')`.

---

## Module: Package

### PKG-1 [HIGH] Form field names don't match DB columns — ✅ DONE
- **Fix**: Renamed `duration`→`duration_days`, `downloads_per_day`→`daily_limit`. Added `monthly_limit`, `allowed_sites`, `currency`, `is_active`.

### PKG-2 [MEDIUM] PackageInfolist missing fields — ✅ DONE (already correct)

---

## Module: Product

### PROD-1 [HIGH] Form field `image` doesn't match DB column `image_url` — ✅ DONE
### PROD-2 [MEDIUM] Missing form fields — ✅ DONE
### PROD-3 [LOW] Product lang missing keys — ✅ DONE

---

## Module: Referral

### REF-1 [HIGH] ReferralForm contains invalid fields for `referrals` table — ✅ DONE
### REF-2 [HIGH] ReferralInfolist contains invalid fields — ✅ DONE
### REF-3 [LOW] Missing `registered_at` lang key — ✅ DONE

---

## Module: Settings (Admin)

### SET-1 [MEDIUM] `key`→`key_name` column mismatch — ✅ DONE
### SET-2 [LOW] Missing `description` form field — ✅ DONE
### SET-3 [LOW] Missing `description` in infolist — ✅ DONE

---

## Module: Settings (Client)

### SETC-1 [HIGH] Fields don't match UserSettingModel — ✅ DONE
- **Fix**: Changed to `notify_email_enabled`, `notify_whatsapp_enabled`.

---

## Module: Subscription

### SUB-1 [LOW] Missing `last_download_date` in infolist — ✅ DONE
- **Fix**: Added to `SubscriptionInfolist` and lang files.

---

## Module: Download

### DWN-1 [LOW] Missing lang keys — ✅ DONE

---

## Module: Currency (Client)

### CURC-1 [MEDIUM] Form sends `currency` code but repo expects `currency_id` — ✅ DONE
- **Fix**: `CurrencyRepository::updateUserCurrencySetting()` now resolves the currency code to a currency ID when `currency` is provided.

---

## Root Language

### DASH-1 [MEDIUM] Missing dashboard nav group translations — ✅ DONE
### DASH-2 [MEDIUM] Missing Arabic dashboard lang file — ✅ DONE

---

## Module: Verification

### VER-1 [MEDIUM] English lang file incomplete — ✅ DONE

---

## Module: Ticket

### TKT-1 [LOW] Lang file asymmetry — ✅ DONE

---

## Environment / Config

### ENV-1 [MEDIUM] Missing browser service env vars in `.env.example` — ✅ DONE
### ENV-2 [LOW] DownloadRepository uses wrong column name — ✅ DONE
