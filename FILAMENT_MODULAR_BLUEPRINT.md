# Filament Admin Panel – Modular Blueprint & Best Practices

This document outlines the standard architecture and implementation patterns for building high-quality, maintainable Filament Admin panels within a modular Laravel architecture.

---

## 1. Modular Directory Structure

Every module that contributes to the Admin panel should follow this structure:

```text
modules/{ModuleName}/
├── Filament/
│   └── Admin/
│       ├── Resources/
│       │   ├── {ResourceName}Resource.php
│       │   ├── {ResourceName}Resource/
│       │   │   └── Pages/
│       │   │       ├── List{ResourceName}s.php
│       │   │       ├── Create{ResourceName}.php
│       │   │       ├── Edit{ResourceName}.php
│       │   │       └── View{ResourceName}.php
│       │   ├── Schemas/
│       │   │   ├── {ResourceName}Form.php
│       │   │   └── {ResourceName}Infolist.php
│       │   └── Tables/
│       │       └── {ResourceName}Table.php
│       └── Widgets/
│           └── {WidgetName}.php
├── Models/
│   └── {ResourceName}Model.php
├── Providers/
│   └── {ModuleName}ServiceProvider.php
└── lang/
    ├── en/
    │   └── {module_name}.php
    └── ar/
        └── {module_name}.php
```

---

## 2. Resource Foundation (The Blueprint)

### 2.1 The Resource Class
Every resource must explicitly define its model, navigation properties, and localization keys.

**Example:** `UserResource.php`
```php
namespace Modules\User\Filament\Admin\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Filament\Admin\Resources\Pages;
use Modules\User\Filament\Admin\Resources\Schemas;
use Modules\User\Filament\Admin\Resources\Tables;
use Modules\User\Models\UserModel;

class UserResource extends Resource
{
    protected static ?string $model = UserModel::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string {
        return __('dashboard.navigation.groups.user_management');
    }

    public static function getNavigationLabel(): string {
        return __('dashboard.resources.user.navigation.label');
    }

    public static function getRecordTitle(?Model $record): string {
        return $record?->name ?? __('dashboard.resources.user.navigation.singular');
    }

    public static function getNavigationBadge(): ?string {
        return cache()->remember('filament.user.count', now()->addMinutes(5), fn() => (string) static::getModel()::count());
    }

    public static function form(Schema $schema): Schema {
        return Schemas\UserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema {
        return Schemas\UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table {
        return Tables\UsersTable::configure($table);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
```

### 2.2 Dedicated Schemas & Tables
Never define large forms or tables directly in the Resource class. Use dedicated classes in `Schemas/` and `Tables/`.

**Form Pattern:**
```php
namespace Modules\User\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\TextInput; // Use correct namespace (see section 5)
use Filament\Schemas\Schema;

class UserForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            TextInput::make('name')->required(),
            // ...
        ]);
    }
}
```

**Infolist Pattern:**
```php
namespace Modules\User\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            TextEntry::make('name'),
            // ...
        ]);
    }
}
```

---

## 3. Localization & Translation

- **Global Strings**: Use `resources/lang/{locale}/dashboard.php` for shared navigation groups and common UI strings.
- **Module Strings**: Use `modules/{Module}/lang/{locale}/{module}.php` for entity-specific fields.
- **Pattern**: Always use `__('path.to.key')`.

---

## 4. Dashboard Widgets Implementation Plan

### 4.1 Data Architecture
- **Service Layer**: Create a `DashboardStatsService` in the **Analytics** module.
- **Repository Integration**: The service calls module repositories (`UserRepository`, `SubscriptionRepository`) to fetch raw data.
- **Caching**: All dashboard data must be cached for at least 15-60 minutes to ensure peak performance.

### 4.2 Modular Widget Strategy
1.  **Placement**: Widgets reside in their domain module (e.g., `modules/User/Filament/Admin/Widgets`).
2.  **Registration**: Widgets are explicitly registered in the `AdminPanelProvider` or discovered via the module loop.
3.  **Checklist**:
    - [ ] Localized headings using module namespace (e.g., `user::widgets.stats.title`).
    - [ ] Polling intervals set sparingly.
    - [ ] Empty states handled (`?? 0` or empty charts).

---

## 5. Namespace Mapping (Legacy vs Modern)

When working with this project, pay close attention to the following namespace mappings, as the project uses a customized schema layer:

| Component Type | Project Namespace (Custom) | Standard Filament Namespace |
|----------------|----------------------------|----------------------------|
| **Form Components** | `Filament\Forms\Components\...` | `Filament\Forms\Components\...` |
| **Table Columns** | `Filament\Tables\Columns\...` | `Filament\Tables\Columns\...` |
| **Infolist Components** | `Filament\Infolists\Components\...` | `Filament\Infolists\Components\...` |
| **Schema Object** | `Filament\Schemas\Schema` | `Filament\Forms\Form` / `Filament\Infolists\Infolist` |

---

## 6. Final Quality Checklist
Before completing any resource:
- [ ] **Table Binding**: `protected $table` is set in the Model.
- [ ] **Record Title**: `getRecordTitle()` is implemented (No raw IDs).
- [ ] **Badge**: `getNavigationBadge()` is cached.
- [ ] **Localization**: No hardcoded strings in PHP or Blade files.
- [ ] **View Page**: `view` route is registered and `ViewRecord` page exists.
- [ ] **Infolist**: `infolist()` method is implemented for rich data viewing.
- [ ] **Dark Mode**: Assets are compiled (`npm run build`).
- [ ] **Hygiene**: Run `vendor/bin/pint` and `php artisan optimize:clear`.
