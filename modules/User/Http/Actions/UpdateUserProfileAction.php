<?php

// modules/User/Http/Actions/UpdateUserProfileAction.php

declare(strict_types=1);

namespace Modules\User\Http\Actions;

use Illuminate\Support\Facades\DB;
use Modules\User\Http\Requests\UpdateProfileRequest;
use Modules\User\Repositories\UserRepository;

final class UpdateUserProfileAction
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    public function __invoke(UpdateProfileRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->userRepository->updateProfile(
                $request->user()->id,
                $request->validated()
            );

            DB::commit();

            return redirect()->route('web.user.profile')
                ->with('success', __('user::messages.profile_updated'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', __('user::errors.profile_update_failed'));
        }
    }
}
