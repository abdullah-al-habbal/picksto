<?php
// modules/Auth/Http/Actions/GetCurrentUserAction.php

declare(strict_types=1);

namespace Modules\Auth\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Auth\Presenters\AuthPresenter;
use Modules\Auth\Repositories\AuthRepository;

final class GetCurrentUserAction
{
    public function __construct(
        private readonly AuthRepository $authRepository,
        private readonly AuthPresenter $authPresenter,
    ) {}

    public function __invoke(Request $request): View
    {
        $user = $this->authRepository->findByIdWithRelations($request->user()->id);

        $presenter = $this->authPresenter->present($user);

        return view('auth::profile.me', [
            'user' => $presenter,
        ]);
    }
}
