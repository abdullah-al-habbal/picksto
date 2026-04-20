<?php
// modules/User/Http/Actions/UploadUserAvatarAction.php

declare(strict_types=1);

namespace Modules\User\Http\Actions;

use Illuminate\Support\Facades\Storage;
use Modules\User\Http\Requests\UploadAvatarRequest;
use Modules\User\Repositories\UserRepository;

final class UploadUserAvatarAction
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    public function __invoke(UploadAvatarRequest $request)
    {
        $file = $request->file('avatar');
        $path = $file->store('avatars', 'public');

        $oldAvatar = $request->user()->avatar;
        if ($oldAvatar && Storage::disk('public')->exists($oldAvatar)) {
            Storage::disk('public')->delete($oldAvatar);
        }

        $this->userRepository->updateAvatar(
            $request->user()->id,
            '/storage/' . $path
        );

        return redirect()->route('web.user.profile')
            ->with('success', __('user::messages.avatar_uploaded'));
    }
}
