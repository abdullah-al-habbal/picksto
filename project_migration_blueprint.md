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
│   │   │   ├── {Resource}.php
│   │   │   ├── Pages/          # List{Entity}, Create{Entity}, Edit{Entity}, View{Entity}
│   │   │   ├── Schemas/        # {Entity}Form.php, {Entity}Infolist.php
│   │   │   ├── Tables/         # {Entity}Table.php
│   │   │   ├── Actions/        # {Entity}Actions.php (Custom logic)
│   │   │   └── RelationManagers/ # Inline relationship management
│   │   ├── Pages/              # Custom standalone pages
│   │   └── Widgets/            # Dashboard widgets
│   └── Client/                 # (Equivalent structure for Client panel)
```

### Naming & Coding Standards
-   **Separated Schemas**: Do not define `form()`, `table()`, or `infolist()` logic directly in the Resource. Instead, use static `configure()` methods.
-   **Custom Actions**: Encapsulate non-CRUD logic (e.g., "Ban User", "Approve Request") in static methods within an `Actions/` class.
-   **Localization**: Use `__('module::file.key')`. Ensure `ServiceProvider` loads translations via `$this->loadTranslationsFrom(...)`.
-   **Navigation Polish**:
    -   `getNavigationGroup()`: Use standard groups from `dashboard.navigation.groups`.
    -   `getNavigationBadge()`: Use cached counts to avoid SQL overhead.
    -   `getRecordTitle()`: Return a string like `#ID - Name` for clear breadcrumbs.

---

## 3. Implementation Patterns (Examples)

### A. The "Separated Schema" Pattern
Instead of bloat in the Resource file, use dedicated schema classes:

**File: `modules/Ticket/Filament/Admin/Resources/Schemas/TicketForm.php`**
```php
public static function configure(Schema $schema): Schema {
    return $schema->components([
        TextInput::make('subject')
            ->label(__('ticket::ticket.fields.subject'))
            ->required(),
        Select::make('status')
            ->options(__('ticket::ticket.statuses'))
            ->required(),
    ]);
}
```

### B. The "Custom Action" Pattern
Encapsulate complex logic outside the table/infolist:

**File: `modules/User/Filament/Admin/Resources/Actions/UserActions.php`**
```php
public static function toggleBan(): Action {
    return Action::make('toggleBan')
        ->label(fn ($record) => $record->is_banned ? 'Unban' : 'Ban')
        ->action(fn ($record) => $record->update(['is_banned' => !$record->is_banned]))
        ->requiresConfirmation()
        ->color('danger');
}
```

### C. Resource Navigation & Titles
**File: `modules/Subscription/Filament/Admin/Resources/SubscriptionResource.php`**
```php
public static function getNavigationBadge(): ?string {
    return (string) cache()->remember('sub_count', 300, fn() => static::getModel()::where('status', 'active')->count());
}

public static function getRecordTitle(?Model $record): string {
    return $record ? "Subscription #{$record->id} ({$record->user->name})" : __('subscription::subscription.labels.singular');
}
```

---

## 4. Migration Checklist & Progress

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

---

## 5. Master Implementation Workflow

### 1. Discovery
- Find the Model in `modules/{Module}/Models/`.
- Identify table columns and relationships.
- Map existing web routes (Admin) to Resource Actions.

### 2. Localization
- Update `lang/en/{module}.php` and `lang/ar/{module}.php`.
- Standard keys: `labels` (singular/plural), `fields`, `statuses`, `messages`.

### 3. Components
- Create `Schemas/{Entity}Form.php`, `Schemas/{Entity}Infolist.php`.
- Create `Tables/{Entity}Table.php` (include standard `View`, `Edit`, `Delete` actions).

### 4. Pages
- Standard stack: `List{Entity}`, `Create{Entity}`, `Edit{Entity}`, `View{Entity}`.
- Wire `HeaderActions` for pages (especially `View` and `Edit`).

### 5. Final Wiring
- Main `{Entity}Resource.php` with correct `navigationGroup`, `navigationIcon`, `navigationBadge`, and `getRelations()`.
- Register the Resource if discovery isn't automatic (though our Providers handle this).

---

## 6. Verification Rules
-   **No Hardcoded Strings**: Every label MUST come from a translation file.
-   **Consistent Icons**: Use `heroicon-o-*` for all navigation.
-   **Responsive Tables**: Ensure `toggleable(isToggledHiddenByDefault: true)` for less critical columns.
-   **Security**: Use `can()` and `Policy` logic for all actions.
