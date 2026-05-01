<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Email Verification Card --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-envelope class="w-5 h-5 text-primary-500" />
                    <span>Email Verification</span>
                </div>
            </x-slot>

            <div class="space-y-4">
                @if ($emailVerified)
                    <div class="flex items-center gap-2 p-3 text-sm rounded-lg bg-success-500/10 text-success-600 dark:text-success-400">
                        <x-heroicon-s-check-circle class="w-5 h-5" />
                        <span>Your email address has been verified.</span>
                    </div>
                @else
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Verify your email address to secure your account and receive important updates.
                    </p>

                    @if ($hasEmail)
                        <div class="flex flex-col gap-4">
                            <x-filament::button
                                wire:click="sendEmailCode"
                                color="gray"
                                icon="heroicon-m-paper-airplane"
                                size="sm"
                            >
                                Send Verification Code
                            </x-filament::button>

                            <div class="flex items-end gap-2">
                                <div class="flex-1">
                                    <x-filament::input.wrapper>
                                        <x-filament::input
                                            type="text"
                                            wire:model="emailCode"
                                            placeholder="Enter 6-digit code"
                                            maxlength="6"
                                        />
                                    </x-filament::input.wrapper>
                                </div>
                                <x-filament::button
                                    wire:click="verifyEmail"
                                    color="primary"
                                    size="sm"
                                >
                                    Verify
                                </x-filament::button>
                            </div>
                        </div>
                    @else
                        <div class="p-3 text-sm rounded-lg bg-warning-500/10 text-warning-600 dark:text-warning-400">
                            Please add an email address in your profile first.
                        </div>
                    @endif
                @endif
            </div>
        </x-filament::section>

        {{-- Phone Verification Card --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-chat-bubble-left-right class="w-5 h-5 text-primary-500" />
                    <span>WhatsApp Verification</span>
                </div>
            </x-slot>

            <div class="space-y-4">
                @if ($phoneVerified)
                    <div class="flex items-center gap-2 p-3 text-sm rounded-lg bg-success-500/10 text-success-600 dark:text-success-400">
                        <x-heroicon-s-check-circle class="w-5 h-5" />
                        <span>Your phone number has been verified via WhatsApp.</span>
                    </div>
                @else
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Verify your phone number via WhatsApp for secure authentication and notifications.
                    </p>

                    @if ($hasPhone)
                        <div class="flex flex-col gap-4">
                            <x-filament::button
                                wire:click="sendPhoneCode"
                                color="gray"
                                icon="heroicon-m-chat-bubble-left-ellipsis"
                                size="sm"
                            >
                                Send WhatsApp Code
                            </x-filament::button>

                            <div class="flex items-end gap-2">
                                <div class="flex-1">
                                    <x-filament::input.wrapper>
                                        <x-filament::input
                                            type="text"
                                            wire:model="phoneCode"
                                            placeholder="Enter 6-digit code"
                                            maxlength="6"
                                        />
                                    </x-filament::input.wrapper>
                                </div>
                                <x-filament::button
                                    wire:click="verifyPhone"
                                    color="primary"
                                    size="sm"
                                >
                                    Verify
                                </x-filament::button>
                            </div>
                        </div>
                    @else
                        <div class="p-3 text-sm rounded-lg bg-warning-500/10 text-warning-600 dark:text-warning-400">
                            Please add a phone number in your profile first.
                        </div>
                    @endif
                @endif
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
