<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Client\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Modules\Verification\Repositories\VerificationRepository;

final class VerificationPage extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Verification';
    protected static ?int $navigationSort = 10;
    protected string $view = 'verification::filament.pages.verification';

    public bool $emailVerified = false;
    public bool $phoneVerified = false;
    public bool $hasEmail = false;
    public bool $hasPhone = false;

    public string $emailCode = '';
    public string $phoneCode = '';

    public function mount(VerificationRepository $repository): void
    {
        $status = $repository->getStatus(auth()->id());
        $this->emailVerified = $status['emailVerified'];
        $this->phoneVerified = $status['phoneVerified'];
        $this->hasEmail = $status['hasEmail'];
        $this->hasPhone = $status['hasPhone'];
    }

    public function sendEmailCode(VerificationRepository $repository): void
    {
        $result = $repository->sendEmailVerification(auth()->id(), 'user_verification');
        
        if ($result['success']) {
            Notification::make()
                ->success()
                ->title($result['message'])
                ->send();
        } else {
            Notification::make()
                ->danger()
                ->title($result['message'])
                ->send();
        }
    }

    public function sendPhoneCode(VerificationRepository $repository): void
    {
        $result = $repository->sendWhatsAppVerification(auth()->id(), 'user_verification');
        
        if ($result['success']) {
            Notification::make()
                ->success()
                ->title($result['message'])
                ->send();
        } else {
            Notification::make()
                ->danger()
                ->title($result['message'])
                ->send();
        }
    }

    public function verifyEmail(VerificationRepository $repository): void
    {
        $result = $repository->verifyCode(auth()->id(), $this->emailCode, 'email');
        
        if ($result['success']) {
            $this->emailVerified = true;
            $this->emailCode = '';
            Notification::make()
                ->success()
                ->title($result['message'])
                ->send();
        } else {
            Notification::make()
                ->danger()
                ->title($result['message'])
                ->send();
        }
    }

    public function verifyPhone(VerificationRepository $repository): void
    {
        $result = $repository->verifyCode(auth()->id(), $this->phoneCode, 'whatsapp');
        
        if ($result['success']) {
            $this->phoneVerified = true;
            $this->phoneCode = '';
            Notification::make()
                ->success()
                ->title($result['message'])
                ->send();
        } else {
            Notification::make()
                ->danger()
                ->title($result['message'])
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Account';
    }
}
