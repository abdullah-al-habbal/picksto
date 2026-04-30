<?php

declare(strict_types=1);

namespace Modules\User\Filament\Client\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepository;

final class ProfilePage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Profile';
    protected static ?int $navigationSort = 1;
    protected string $view = 'filament.pages.profile';

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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profile Information')
                    ->description('Update your personal information')
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Avatar')
                            ->avatar()
                            ->image()
                            ->maxSize(5 * 1024)
                            ->directory('avatars')
                            ->deleteUploadedFileUsing(function (string $file): void {
                                Storage::disk('public')->delete($file);
                            }),
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->minLength(2)
                            ->maxLength(100),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->unique(User::class, 'email', ignoreRecord: true),
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->placeholder('+1 (555) 000-0000'),
                        TextInput::make('profession')
                            ->label('Profession')
                            ->maxLength(100),
                        TextInput::make('companySize')
                            ->label('Company Size')
                            ->maxLength(50),
                    ])
                    ->columns(2),
            ])
            ->statePath('data')
            ->model(auth()->user());
    }

    public function save(): void
    {
        $data = $this->form->getState();

        try {
            $userRepository = app(UserRepository::class);
            $user = auth()->user();

            // Handle avatar upload
            if (isset($data['avatar']) && $data['avatar'] !== $user->avatar) {
                // Delete old avatar if exists
                if ($user->avatar) {
                    $oldPath = str_replace('/storage/', '', $user->avatar);
                    Storage::disk('public')->delete($oldPath);
                }

                // Update avatar path
                if ($data['avatar']) {
                    $data['avatar'] = '/storage/' . $data['avatar'];
                }
            }

            // Update profile
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
