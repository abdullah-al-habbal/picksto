declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Admin route only
Route::middleware(['auth', 'role:admin'])->post('settings', \Modules\Settings\Http\Actions\UpdateSettingsAction::class)->name('settings.update');
