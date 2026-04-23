<?php

// modules/User/Http/Actions/ToggleUserBanAction.php

declare(strict_types=1);

namespace Modules\User\Http\Actions;

use Illuminate\Http\Request;
use Modules\User\Repositories\UserRepository;

final class ToggleUserBanAction
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    public function __invoke(Request $request, int $user)
    {
        $validated = $request->validate([
            'isBanned' => ['required', 'boolean'],
        ]);

        $this->userRepository->updateBanStatus($user, $validated['isBanned']);

        $message = $validated['isBanned']
            ? __('user::messages.user_banned')
            : __('user::messages.user_unbanned');

        return redirect()->route('web.admin.users.show', $user)
            ->with('success', $message);
    }
}
