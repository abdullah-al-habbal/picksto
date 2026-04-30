declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Admin route only
Route::middleware(['auth', 'role:admin'])->put('currency/settings', \Modules\Currency\Http\Actions\UpdateCurrencySettingsAction::class)->name('currency.settings.update');
