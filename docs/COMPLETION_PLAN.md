# 🎯 PICKSTO PROJECT COMPLETION PLAN

**Created**: April 26, 2026  
**Framework**: Laravel 12 + Filament v5  
**Status**: 85% Admin Panel | 0% Client Panel

---

## 📊 CURRENT STATE ANALYSIS

### ✅ Admin Panel: 85% Complete

**Fully Implemented (Full CRUD - All 4 Pages):**
| Module | Resource | Pages | Forms | Tables | Infolists |
|--------|----------|-------|-------|--------|-----------|
| Currency | CurrencySettingResource | ✅ | ✅ | ✅ | ✅ |
| Payment | PaymentGatewayResource | ✅ | ✅ | ✅ | ✅ |
| Subscription | SubscriptionResource | ✅ | ✅ | ✅ | ✅ |
| Ticket | TicketResource | ✅ + RelationManager | ✅ | ✅ | ✅ |
| Verification | VerificationCodeResource | ✅ | ✅ | ✅ | ✅ |
| Package | PackageResource | ✅ | ✅ | ✅ | ✅ |
| Referral | ReferralResource | ✅ | ✅ | ✅ | ✅ |
| Analytics | Dashboard Widgets | 4 Widgets | - | - | - |

**Partially Implemented (List/View Only):**
| Module | Pages | Missing | Status |
|--------|-------|---------|--------|
| Download | List, View | Create, Edit | ⏳ Add CRUD pages |
| Settings | List, View, Edit | Create | ⏳ Add Create page |
| User | EditProfile only | Full Resource | ⏳ Build UserResource |

**Not Implemented:**
| Module | Reason | Priority |
|--------|--------|----------|
| Product | Zero Filament code | 🔴 HIGH |
| SubscriptionRequest | Missing from search | 🔴 HIGH |
| Auth | Only EditProfile exists | 🟡 MEDIUM |
| LemonSqueezy | Integration exists, no UI | 🟡 MEDIUM |

---

### ❌ Client Panel: 0% Complete

**Required Resources** (one per module):

1. **User** - Profile & Settings Dashboard
2. **Subscription** - "My Plan" with upgrade options
3. **Download** - "My Downloads" history
4. **Ticket** - "My Support Tickets" & create new
5. **SubscriptionRequest** - "Request Upgrade" form
6. **Payment** - "Payment Methods" & history
7. **Referral** - "Invite Friends" with referral links
8. **Verification** - "My Verifications" status
9. **Package** - Public browse/compare packages
10. **Analytics** - Client-side dashboard widgets

---

## 🏗️ IMPLEMENTATION ROADMAP

### PHASE 1: Admin Panel Completion (5-7 days)

#### Step 1.1: Product Module (HIGH PRIORITY)

**Action**: Create full CRUD resource for products  
**Files to Create**:

```
modules/Product/Filament/Admin/Resources/
├── ProductResource.php
├── Pages/
│   ├── ListProducts.php
│   ├── CreateProduct.php
│   ├── EditProduct.php
│   └── ViewProduct.php
├── Schemas/
│   ├── ProductForm.php
│   └── ProductInfolist.php
└── Tables/
    └── ProductsTable.php
```

**Model Reference**: `ProductModel` with fields:

- `name_ar`, `name_en` (bilingual)
- `description_ar`, `description_en`
- `price`, `sku`
- `active` (boolean)

**Key Features**:

- Locale-aware name/description (use SpatieTranslatable)
- Price formatting with currency selector
- Active/Inactive status toggle
- Bilingual validation messages

---

#### Step 1.2: User Module (HIGH PRIORITY)

**Action**: Build complete UserResource beyond EditProfile  
**Files to Create**:

```
modules/User/Filament/Admin/Resources/
├── UserResource.php
├── Pages/
│   ├── ListUsers.php
│   ├── CreateUser.php
│   ├── EditUser.php
│   └── ViewUser.php
├── Schemas/
│   ├── UserForm.php
│   └── UserInfolist.php
└── Tables/
    └── UsersTable.php
```

**Existing Fields** (from EditProfile):

- name, email, phone, profession, company_size, avatar
- password (for create/edit)

**Admin-Only Fields**:

- Role/Permissions (if exists)
- Account status (active/suspended)
- Registration date filters

---

#### Step 1.3: Download Module Completion (MEDIUM)

**Action**: Add Create & Edit pages to DownloadResource  
**Current**: ListDownloads.php, ViewDownload.php  
**Missing**: CreateDownload.php, EditDownload.php  
**Effort**: ~30 minutes

---

#### Step 1.4: Settings Module Completion (MEDIUM)

**Action**: Add CreateSetting page  
**Current**: ListSettings.php, ViewSetting.php, EditSetting.php  
**Missing**: CreateSetting.php  
**Effort**: ~15 minutes

---

#### Step 1.5: SubscriptionRequest Module (HIGH)

**Action**: Find/Build SubscriptionRequestResource  
**Status**: Module exists in bootstrap/providers.php but no Filament code found  
**Required**: Same CRUD pattern as others

**Model**: Likely `SubscriptionRequestModel` with:

- user_id, current_package_id, requested_package_id
- status (pending, approved, rejected)
- reason, created_at

---

#### Step 1.6: LemonSqueezy Admin UI (MEDIUM)

**Action**: Create admin dashboard resource  
**Existing**: LemonSqueezyRepository with HTTP API wrapper  
**Needed**: Resource to view:

- LemonSqueezy products/variants
- Customer list & subscriptions
- Webhook logs/events
- Transaction history

---

#### Step 1.7: Ensure All Resources Have View Pages

**Validation**: Every resource should have 4 pages:

1. ListRecords (index)
2. CreateRecord (create) - Not needed for Download, Settings, etc.
3. ViewRecord (view)
4. EditRecord (edit)

**Scan & Fix**: Some resources might be missing View pages

---

### PHASE 2: Client Panel Creation (7-10 days)

#### Step 2.1: User Client Resource

**Purpose**: User profile, settings, account management  
**Features**:

- View profile with edit capability
- Change password
- View avatar
- Account preferences

---

#### Step 2.2: Subscription Client Resource

**Purpose**: "My Plan" dashboard  
**Features**:

- Current subscription details
- Usage statistics (downloads today/month)
- Upgrade/Downgrade options
- Renewal date & auto-renewal toggle
- Payment method

---

#### Step 2.3: Download Client Resource

**Purpose**: "My Downloads" history  
**Features**:

- List all user's downloads
- Download date, file name, size
- Re-download capability
- Filter by date range, status

---

#### Step 2.4: Ticket Client Resource

**Purpose**: "My Support Tickets"  
**Features**:

- Create new ticket form
- List user's tickets
- View ticket & replies
- Reply to ticket
- Close/reopen functionality

---

#### Step 2.5: SubscriptionRequest Client Resource

**Purpose**: "Request Upgrade/Downgrade"  
**Features**:

- Form to request plan change
- Current plan vs requested plan
- Reason field
- Request history
- Status tracking (pending/approved/rejected)

---

#### Step 2.6: Payment Client Resource

**Purpose**: "Payment Methods & History"  
**Features**:

- Saved payment methods (if applicable)
- Payment history/invoices
- Download receipts
- Retry failed payments

---

#### Step 2.7: Referral Client Resource

**Purpose**: "Invite Friends"  
**Features**:

- Copy/share referral link
- Referral statistics (invited, claimed, expired)
- Earnings tracking
- Referral history

---

#### Step 2.8: Verification Client Resource

**Purpose**: "Verify Identity"  
**Features**:

- Verification status view
- Resend verification code
- Identity verification form
- Verification history

---

#### Step 2.9: Package Client Resource

**Purpose**: "Browse & Compare Packages"  
**Features**:

- Public package listing
- Package comparison table
- Pricing details
- Feature list per package
- "Choose Plan" button

---

### PHASE 3: Polish & Optimization (3-5 days)

#### Step 3.1: Dashboard Widgets

**Admin Dashboard**: ✅ Already 4 widgets
**Client Dashboard**: 🔲 Create equivalent

- Account balance/credits
- Recent transactions
- Subscription status
- Downloads available

#### Step 3.2: Translations

**Check**: All modules have bilingual (en/ar) translations  
**Validate**: No hardcoded strings in forms/tables/infolists

#### Step 3.3: Testing

- Admin: CRUD for each resource
- Client: Read/Update operations
- Permissions: Admin-only vs authenticated
- Validation: Form errors display properly

#### Step 3.4: Performance

- Cache badges & counts
- Lazy-load heavy relationships
- Optimize queries (eager load)
- Index frequently filtered columns

---

## 🛠️ IMPLEMENTATION CHECKLIST

### Code Standards (from PROJECT_STATE.md)

- [ ] `declare(strict_types=1);` at top
- [ ] All parameters typed
- [ ] All return types declared
- [ ] Constructor DI only
- [ ] Proper PHPDoc blocks
- [ ] Run `vendor/bin/pint` before commit
- [ ] Run `php -l` for syntax validation

### Filament Standards (from FILAMENT_MODULAR_BLUEPRINT.md)

- [ ] Resource has model binding
- [ ] `getRecordTitle()` returns human-readable string
- [ ] `getNavigationBadge()` cached for performance
- [ ] All strings localized (no hardcoded UI text)
- [ ] View page registered in `getPages()`
- [ ] Infolist implemented with rich data
- [ ] Schemas in separate `Schemas/` directory
- [ ] Tables in separate `Tables/` directory
- [ ] Forms in `Schemas/{Entity}Form.php`

### Filament V5 Specifics

- [ ] Use `Filament\Schemas\Schema` (not `Form`)
- [ ] Use `Filament\Forms\Components\*` for form components
- [ ] Use `Filament\Tables\Columns\*` for table columns
- [ ] Use `Filament\Infolists\Components\*` for infolist entries

---

## 📁 DIRECTORY TREE - FINAL STATE

```
modules/
├── Analytics/
│   └── Filament/Admin/Widgets/ ✅ (4 widgets)
├── Auth/ (LoginPage only, extend if needed)
├── Currency/
│   └── Filament/Admin/Resources/ ✅
├── Download/
│   └── Filament/Admin/Resources/ ⏳ (add Create/Edit)
├── LemonSqueezy/
│   └── Filament/Admin/Resources/ 🔲 (to build)
├── Package/
│   └── Filament/Admin/Resources/ ✅
│   └── Filament/Client/Resources/ 🔲 (to build)
├── Payment/
│   └── Filament/Admin/Resources/ ✅
│   └── Filament/Client/Resources/ 🔲 (to build)
├── Product/
│   └── Filament/Admin/Resources/ 🔲 (to build)
│   └── Filament/Client/Resources/ 🔲 (to build)
├── Referral/
│   └── Filament/Admin/Resources/ ✅
│   └── Filament/Client/Resources/ 🔲 (to build)
├── Settings/
│   └── Filament/Admin/Resources/ ⏳ (add Create)
├── Subscription/
│   └── Filament/Admin/Resources/ ✅
│   └── Filament/Client/Resources/ 🔲 (to build)
├── SubscriptionRequest/
│   └── Filament/Admin/Resources/ 🔲 (to build)
│   └── Filament/Client/Resources/ 🔲 (to build)
├── Ticket/
│   └── Filament/Admin/Resources/ ✅
│   └── Filament/Client/Resources/ 🔲 (to build)
├── Upload/
│   └── Filament/ 🔲 (may need resource)
├── User/
│   ├── Filament/Admin/Resources/ 🔲 (to build)
│   ├── Filament/Admin/Pages/EditProfile.php ✅
│   └── Filament/Client/Resources/ 🔲 (to build)
└── Verification/
    └── Filament/Admin/Resources/ ✅
    └── Filament/Client/Resources/ 🔲 (to build)
```

---

## ⏱️ TIME ESTIMATES

| Phase                  | Task                      | Estimate          | Priority |
| ---------------------- | ------------------------- | ----------------- | -------- |
| 1                      | Product Admin CRUD        | 3-4 hours         | 🔴 HIGH  |
| 1                      | User Admin Resource       | 2-3 hours         | 🔴 HIGH  |
| 1                      | SubscriptionRequest Admin | 2-3 hours         | 🔴 HIGH  |
| 1                      | Download completion       | 30 min            | 🟢 LOW   |
| 1                      | Settings completion       | 15 min            | 🟢 LOW   |
| 1                      | LemonSqueezy Admin UI     | 1-2 hours         | 🟡 MED   |
| 1                      | Fix missing View pages    | 1 hour            | 🟡 MED   |
| **Phase 1 Total**      | **Admin Panel**           | **~10-12 hours**  |          |
| 2                      | 9 Client Resources        | 1-1.5 hrs each    | 🟡 MED   |
| 2                      | Client Widgets            | 2-3 hours         | 🟡 MED   |
| **Phase 2 Total**      | **Client Panel**          | **~13-18 hourIs** |          |
| 3                      | Testing, Polish, Docs     | 3-5 hours         | 🟢 LOW   |
| **Total Project Time** | **Full Completion**       | **~26-35 hours**  |          |

---

## 🚀 EXECUTION PRIORITY

**Recommended Order:**

1. **Product Admin** (HIGH - blocks everything)
2. **User Admin** (HIGH - needed for testing)
3. **SubscriptionRequest Admin** (HIGH - required for completeness)
4. **Fix Download/Settings** (QUICK - finish admin)
5. **LemonSqueezy Admin** (MED - nice to have)
6. **Client Resources** (MED - bulk work, 9 modules)
7. **Translations + Testing** (LOW - final polish)

---

## 📝 NOTES & REFERENCES

**Key Files to Reference:**

- [FILAMENT_MODULAR_BLUEPRINT.md](FILAMENT_MODULAR_BLUEPRINT.md) - Architecture patterns
- [PROJECT_STATE.md](PROJECT_STATE.md) - Database models & API endpoints
- [project_migration_blueprint.md](project_migration_blueprint.md) - Migration checklist
- [AdminPanelProvider.php](app/Providers/Filament/AdminPanelProvider.php) - Auto-discovery config
- [ClientPanelProvider.php](app/Providers/Filament/ClientPanelProvider.php) - Client panel config

**Translation Files:**

```
resources/lang/{en,ar}/dashboard.php          # Global UI strings
modules/{Module}/lang/{en,ar}/{module}.php     # Module-specific strings
```

**Example Complete Resources:**

- `modules/Currency/Filament/Admin/Resources/CurrencySettingResource.php`
- `modules/Subscription/Filament/Admin/Resources/SubscriptionResource.php`
- Use these as templates for new resources

---

## ✨ NEXT STEPS

1. **Start with Product Module** - Most important blocker
2. **Review FILAMENT_MODULAR_BLUEPRINT.md** - Best practices
3. **Copy patterns from Currency/Subscription** - Working examples
4. **Test each resource** - CRUD operations
5. **Deploy incrementally** - One module at a time

---

**Status**: Ready for implementation  
**Last Updated**: April 26, 2026
