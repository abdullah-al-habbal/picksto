<?php
// modules/User/Http/Actions/GetUserProfileAction.php

declare(strict_types=1);

namespace Modules\User\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\User\Repositories\UserRepository;
use Modules\User\Presenters\UserPresenter;

final class GetUserProfileAction
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPresenter $userPresenter,
    ) {}

    public function __invoke(Request $request): View
    {
        $user = $this->userRepository->findById($request->user()->id);

        $user->updateLastLogin();

        $presenter = $this->userPresenter->present($user);

        return view('user::profile.show', [
            'user' => $presenter,
        ]);
    }
}
