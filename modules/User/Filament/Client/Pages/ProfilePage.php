<?php

declare(strict_types=1);

namespace Modules\User\Filament\Client\Pages;

use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Filament\Client\Schemas\ProfileForm;

final class ProfilePage extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Profile';
    protected static ?int $navigationSort = 1;
    protected string $view = 'user::filament.pages.profile';

    public ?array $data = [];

    public function __construct()
    {
        parent::__construct();

        $user = auth()->user();
        $this->data = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'profession' => $user->profession,
            'companySize' => $user->companySize,
            'avatar' => $user->avatar ? str_replace('/storage/', '', $user->avatar) : null,
        ];
    }

    public function form(Schema $schema): Schema
    {
        return ProfileForm::configure($schema)
            ->statePath('data')
            ->model(auth()->user());
    }

    public function save(): void
    {
        $data = $this->form->getState();

        try {
            $userRepository = app(UserRepository::class);
            $user = auth()->user();

            if (isset($data['avatar']) && $data['avatar'] !== $user->avatar) {
                if ($user->avatar) {
                    $oldPath = str_replace('/storage/', '', $user->avatar);
                    Storage::disk('public')->delete($oldPath);
                }

                if ($data['avatar']) {
                    $data['avatar'] = '/storage/' . $data['avatar'];
                }
            }

            $userRepository->updateProfile($user->id, $data);

            Notification::make()
                ->success()
                ->title('Profile Updated')
                ->body('Your profile has been updated successfully.')
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Update Failed')
                ->body('Failed to update your profile. Please try again.')
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Account';
    }
}
