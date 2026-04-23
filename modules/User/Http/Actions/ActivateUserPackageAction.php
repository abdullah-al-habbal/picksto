<?php

// modules/User/Http/Actions/ActivateUserPackageAction.php

declare(strict_types=1);

namespace Modules\User\Http\Actions;

use Illuminate\Http\Request;
use Modules\User\Repositories\UserRepository;

final class ActivateUserPackageAction
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    public function __invoke(Request $request, int $user)
    {
        $validated = $request->validate([
            'packageId' => ['required', 'integer', 'min:1'],
            'durationDays' => ['required', 'integer', 'min:1', 'max:365'],
        ]);

        $this->userRepository->activatePackage(
            $user,
            $validated['packageId'],
            $validated['durationDays']
        );

        return redirect()->route('web.admin.users.show', $user)
            ->with('success', __('user::messages.package_activated', [
                'days' => $validated['durationDays'],
            ]));
    }
}
