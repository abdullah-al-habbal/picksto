<?php

// modules/User/Http/Actions/ChangeUserRoleAction.php

declare(strict_types=1);

namespace Modules\User\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\User\Repositories\UserRepository;

final class ChangeUserRoleAction
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    public function __invoke(Request $request, int $user)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(['user', 'admin', 'supervisor'])],
        ]);

        $this->userRepository->updateRole($user, $validated['role']);

        return redirect()->route('web.admin.users.show', $user)
            ->with('success', __('user::messages.role_updated'));
    }
}
