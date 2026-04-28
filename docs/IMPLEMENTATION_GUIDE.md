# 🔧 IMPLEMENTATION QUICK-REFERENCE GUIDE

## PHASE 1: Admin Panel Completion

### Priority Task #1: Build Product Admin Resource

**Step 1: Examine Product Model**
```bash
# Find model structure
cat modules/Product/Models/ProductModel.php
```

**Step 2: Create Resource File Structure**
```
modules/Product/Filament/Admin/
├── Resources/
│   ├── ProductResource.php          (Main resource)
│   ├── Pages/
│   │   ├── ListProducts.php
│   │   ├── CreateProduct.php
│   │   ├── EditProduct.php
│   │   └── ViewProduct.php
│   ├── Schemas/
│   │   ├── ProductForm.php
│   │   └── ProductInfolist.php
│   └── Tables/
│       └── ProductsTable.php
```

**Step 3: Use as Template**
```
Copy from: modules/Currency/Filament/Admin/Resources/CurrencySettingResource.php
Adapt for: ProductModel with:
  - Bilingual name_ar, name_en
  - Bilingual description_ar, description_en
  - Price field (numeric)
  - Active toggle
```

**Step 4: Translation Keys Needed**
```php
// modules/Product/lang/en/product.php
'labels' => [
    'singular' => 'Product',
    'plural' => 'Products',
    'products' => 'Products',
],
'fields' => [
    'name' => 'Product Name',
    'description' => 'Description',
    'price' => 'Price',
    'active' => 'Active',
    'sku' => 'SKU',
    'created_at' => 'Created',
],
```

**Step 5: Validation in Form**
```php
TextInput::make('price')
    ->label(__('product::product.fields.price'))
    ->numeric()
    ->required()
    ->minValue(0),
```

---

### Priority Task #2: Build User Admin Resource

**Template**: Use `modules/Subscription/Filament/Admin/Resources/SubscriptionResource.php`

**Key Fields**:
```php
Select::make('role')
    ->label(__('dashboard.fields.role'))
    ->options([...]) // Define roles
    ->required(),

TextInput::make('email')
    ->email()
    ->required()
    ->unique(ignoreRecord: true),

TextInput::make('name')
    ->required(),

TextInput::make('phone'),
TextInput::make('profession'),
TextInput::make('company_size'),

FileUpload::make('avatar')
    ->image()
    ->directory('avatars'),

Select::make('status')
    ->options([
        'active' => 'Active',
        'suspended' => 'Suspended',
    ]),
```

---

### Priority Task #3: SubscriptionRequest Admin Resource

**Steps**:
1. Find `modules/SubscriptionRequest/Models/SubscriptionRequestModel.php`
2. Review fields: `user_id`, `current_package_id`, `requested_package_id`, `status`, `reason`, etc.
3. Build resource similar to SubscriptionResource
4. Add navigation group: `__('dashboard.navigation.groups.subscriptions')`

---

### Quick Fixes (Download & Settings)

**Download Module** - Add 2 files:
```php
// modules/Download/Filament/Admin/Resources/Pages/CreateDownload.php
use Filament\Resources\Pages\CreateRecord;

class CreateDownload extends CreateRecord
{
    protected static string $resource = DownloadResource::class;
}

// modules/Download/Filament/Admin/Resources/Pages/EditDownload.php
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditDownload extends EditRecord
{
    protected static string $resource = DownloadResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
```

**Update**: `modules/Download/Filament/Admin/Resources/DownloadResource.php`
```php
public static function getPages(): array
{
    return [
        'index' => ListDownloads::route('/'),
        'create' => CreateDownload::route('/create'),
        'edit' => EditDownload::route('/{record}/edit'),
        'view' => ViewDownload::route('/{record}'),
    ];
}
```

**Settings Module** - Same approach, add `CreateSetting.php`

---

## PHASE 2: Client Panel Creation

### Template for Client Resources

**File Structure** (same as Admin, different path):
```
modules/{Module}/Filament/Client/Resources/
├── {Resource}Resource.php
├── Pages/
│   ├── List{Resources}.php
│   ├── Create{Resource}.php (if applicable)
│   ├── Edit{Resource}.php (if applicable)
│   └── View{Resource}.php
├── Schemas/
│   ├── {Resource}Form.php
│   └── {Resource}Infolist.php
└── Tables/
    └── {Resources}Table.php
```

### Key Differences: Client vs Admin

| Aspect | Admin | Client |
|--------|-------|--------|
| **Scope** | All entities | User's own entities |
| **Query** | `Model::all()` | `Model::whereUserId(auth()->id())` |
| **Actions** | Full CRUD | Read/Update only (mostly) |
| **Relationships** | Global | User-specific |
| **Navigation** | Full hierarchy | Simplified |

### Example: User Client Resource

```php
// modules/User/Filament/Client/Resources/ProfileResource.php

class ProfileResource extends Resource
{
    protected static ?string $model = UserModel::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereId(auth()->id());
    }

    public static function form(Schema $schema): Schema
    {
        return ProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfileTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProfiles::route('/'),
            'edit' => EditProfile::route('/{record}/edit'),
        ];
    }
}
```

### Example: Subscription Client Resource (My Plan)

```php
// modules/Subscription/Filament/Client/Resources/MySubscriptionResource.php

class MySubscriptionResource extends Resource
{
    protected static ?string $model = SubscriptionModel::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMySubscriptions::route('/'),
            'view' => ViewMySubscription::route('/{record}'),
        ];
    }
}
```

### Example: Referral Client Resource (Invite Friends)

```php
// modules/Referral/Filament/Client/Resources/MyReferralResource.php

class MyReferralResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('referrer_id', auth()->id());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('referred.name')->label(__('referral::referral.fields.referred')),
                TextColumn::make('status')->badge(),
                TextColumn::make('claimed_at')->dateTime(),
            ])
            ->filters([...]);
    }
}
```

---

## Code Generation Checklist

For EACH new resource, verify:

- [ ] **Namespace correct**: `Modules\{Module}\Filament\{Admin|Client}\Resources`
- [ ] **Model imported**: `use Modules\{Module}\Models\{Model}Model;`
- [ ] **Navigation set**: `getNavigationGroup()`, `getNavigationLabel()`
- [ ] **Record title**: `getRecordTitle()` returns readable string
- [ ] **Localization**: All strings use `__('key')`
- [ ] **Form validated**: Field types match model
- [ ] **Table sortable**: Add `->sortable()` to important columns
- [ ] **Searchable fields**: Add `->searchable()` for name/email/etc
- [ ] **Badges colored**: Use appropriate colors for status fields
- [ ] **Timestamps hidden**: `->toggleable(isToggledHiddenByDefault: true)`
- [ ] **Admin-only middleware**: `->can('create', 'view', 'update', 'delete')` if needed
- [ ] **Tests written**: PHPUnit feature tests for CRUD

---

## Testing After Implementation

```bash
# Test syntax
php -l modules/Product/Filament/Admin/Resources/ProductResource.php

# Format code
vendor/bin/pint modules/Product/Filament/Admin/Resources/

# Run tests
php artisan test tests/Feature/Modules/Product/

# Clear cache
php artisan optimize:clear
```

---

## Common Patterns & Snippets

### Bilingual Form (Product Example)
```php
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class ProductForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            TextInput::make('name')
                ->label(__('product::product.fields.name'))
                ->required(),
            Textarea::make('description')
                ->label(__('product::product.fields.description')),
        ]);
    }
}
```

### Status Badge Coloring
```php
TextColumn::make('status')
    ->badge()
    ->color(fn (string $state): string => match ($state) {
        'active' => 'success',
        'pending' => 'warning',
        'inactive' => 'danger',
        default => 'gray',
    })
```

### Cached Navigation Badge
```php
public static function getNavigationBadge(): ?string
{
    return cache()->remember(
        'filament.resource.product.count',
        now()->addMinutes(5),
        fn () => (string) static::getModel()::count()
    );
}
```

### User-Scoped Query (Client Panel)
```php
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('user_id', auth()->id());
}
```

### Relationship Select
```php
Select::make('user_id')
    ->relationship('user', 'name')
    ->searchable()
    ->required()
```

### File Upload
```php
FileUpload::make('avatar')
    ->label(__('dashboard.fields.avatar'))
    ->image()
    ->directory('avatars')
    ->disk('public')
```

---

## Troubleshooting

**Issue**: Resource not appearing in admin panel
**Solution**: Check `app/Providers/Filament/AdminPanelProvider.php` auto-discovery or register manually

**Issue**: Localization key not found
**Solution**: Add key to `modules/{Module}/lang/{en,ar}/{module}.php`

**Issue**: Form component not rendering
**Solution**: Check namespace - use `Filament\Forms\Components\*` not `Filament\Schemas\Components\*`

**Issue**: Relationship dropdown not loading
**Solution**: Ensure `->searchable()` and model relationship is defined

**Issue**: Tests failing on migration
**Solution**: Run `php artisan migrate:fresh --seed` in test environment

---

## Resources for Reference

- **Existing Complete Resources**: 
  - `modules/Currency/Filament/Admin/Resources/CurrencySettingResource.php`
  - `modules/Subscription/Filament/Admin/Resources/SubscriptionResource.php`

- **Documentation**:
  - FILAMENT_MODULAR_BLUEPRINT.md
  - PROJECT_STATE.md
  - project_migration_blueprint.md

- **Official Docs**:
  - https://filamentphp.com/docs
  - https://laravel.com/docs

---

**Last Updated**: April 26, 2026  
**Ready to Build**: ✅ Start with Product Module
