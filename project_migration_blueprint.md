# Filament Migration & Two-Panel Architecture Blueprint

## 1. Project Context
This is a modular Laravel application where business logic is encapsulated in `modules/`. The goal is to replace traditional web routes with **Filament v5** panels while maintaining a clean, decoupled architecture.

### Panels
1.  **Admin Panel** (`/admin`): Full CRUD and management for administrators.
2.  **Client Panel** (`/client`): User-facing dashboard for customers.

---

## 2. Architecture & Conventions

### Directory Structure
Each module follows this structure for Filament integration:
```text
modules/{Module}/
├── Filament/
│   ├── Admin/
│   │   ├── Resources/
│   │   │   ├── Pages/
│   │   │   ├── Schemas/      # Static configure() methods for Form/Infolist
│   │   │   ├── Tables/       # Static configure() methods for Tables
│   │   │   └── {Resource}.php
│   │   ├── Pages/            # Custom standalone pages
│   │   └── Widgets/          # Custom widgets
│   └── Client/               # Equivalent structure for the Client panel
```

### Naming & Coding Standards
-   **Separated Schemas**: Do not define `form()`, `table()`, or `infolist()` logic directly in the Resource. Instead, use static `configure()` methods in dedicated classes under `Schemas/` and `Tables/`.
-   **Custom Actions**: Place custom logic in `Actions/` directories as static methods returning Filament `Action` objects (e.g., `UserActions::toggleBan()`).
-   **Localization**: Use `__('module::file.key')`. Ensure `ServiceProvider` loads translations via `$this->loadTranslationsFrom(...)`.
-   **Navigation Polish**:
    -   `getNavigationGroup()`: Use standard groups (e.g., `dashboard.navigation.groups.sales`).
    -   `getNavigationBadge()`: Use cached counts (e.g., `cache()->remember('...', now()->addMinutes(5), ...)`).
    -   `getRecordTitle()`: Return descriptive titles for breadcrumbs.

---

## 3. Migration Checklist & Progress

### Core Modules Status
| Module | Admin Status | Client Status | Notes |
| :--- | :--- | :--- | :--- |
| **User** | ✅ Complete | ⏳ Pending | Needs Client Profile/Settings. |
| **Ticket** | ✅ Complete | ⏳ Pending | Needs Client "My Tickets". |
| **SubscriptionRequest** | ✅ Complete | ⏳ Pending | Needs Client "Request Upgrade". |
| **Subscription** | ✅ Complete | ⏳ Pending | Needs Client "My Plan". |
| **Payment** | ✅ Complete | ⏳ Pending | Needs Client "Payment Methods". |
| **Referral** | ✅ Complete | ⏳ Pending | Needs Client "Invite Friends". |
| **Verification** | ✅ Complete | ⏳ Pending | Needs Client "Identity Verification". |
| **Currency** | ✅ Complete | ❌ N/A | Admin-only settings. |
| **Settings** | ✅ Complete | ❌ N/A | Admin-only settings. |
| **Download** | ✅ Complete | ⏳ Pending | Needs Client "My Downloads". |
| **Package** | 🟠 Partial | ⏳ Pending | Verify full Admin CRUD. |
| **Product** | ⏳ Not Started | ⏳ Not Started | Needs full CRUD. |
| **Analytics** | 🟠 Widgets Done | ❌ N/A | Admin-only dashboard. |
| **LemonSqueezy** | ⏳ Not Started | ⏳ Not Started | API integration visibility. |

---

## 4. Implementation Workflow for Agent

### Phase 1: Project Scan
1.  List all directories in `modules/`.
2.  Check for `Models/` in each module to identify data entities.
3.  Check `Routes/web.php` to map existing admin actions.

### Phase 2: Implementation (Per Module)
1.  **Directories**: Create the standard structure if missing.
2.  **Translations**: Update `lang/{en,ar}/{file}.php` with `labels`, `fields`, and `statuses`.
3.  **Schemas**:
    -   `{Entity}Form.php`: All fillable fields.
    -   `{Entity}Infolist.php`: Visual summary for View pages.
    -   `{Entity}Table.php`: Columns, Filters, and standard/custom Actions.
4.  **Pages**: Create standard `List`, `Create`, `Edit`, and `View` page classes.
5.  **Resource**: Create the main Resource class, wire the schemas, and add navigation polish.
6.  **Relations**: Add `RelationManagers` where entities are nested (e.g., `Invoices` under `Subscription`).

### Phase 3: Client Panel Setup
1.  Ensure `ClientPanelProvider` is registered and uses the same discovery logic as `AdminPanelProvider` but pointed to `Filament/Client`.
2.  Implement user-facing resources with restricted permissions (e.g., users can only see their own records).

---

## 5. Critical Verification
-   **Translations**: No hardcoded strings; everything must support EN/AR.
-   **Caching**: Navigation badges must not cause database bottlenecks (use cache).
-   **UX**: Breadcrumbs and Record Titles must be human-readable.
-   **Security**: Ensure the Client panel is restricted to the authenticated user's data.
