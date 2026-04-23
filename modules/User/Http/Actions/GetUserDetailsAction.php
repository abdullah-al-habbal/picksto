<?php

// modules/User/Http/Actions/GetUserDetailsAction.php

declare(strict_types=1);

namespace Modules\User\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\User\Presenters\UserPresenter;
use Modules\User\Repositories\UserRepository;

final class GetUserDetailsAction
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPresenter $userPresenter,
    ) {}

    public function __invoke(Request $request, ?int $user = null): View
    {
        if ($user) {
            $targetUser = $this->userRepository->findByIdWithRelations($user);
            $presenter = $this->userPresenter->presentDetailed($targetUser);

            return view('user::admin.show', [
                'user' => $presenter,
            ]);
        }

        $users = $this->userRepository->getAllWithPagination(
            $request->get('per_page', 20),
            $request->get('search')
        );

        $presentedUsers = $users->map(fn ($u) => $this->userPresenter->presentList($u)
        );

        return view('user::admin.index', [
            'users' => $presentedUsers,
            'search' => $request->get('search'),
        ]);
    }
}
