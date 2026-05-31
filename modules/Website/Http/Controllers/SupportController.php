<?php

declare(strict_types=1);

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Website\Handlers\CreateTicketHandler;
use Modules\Website\Handlers\GetSettingByKeyHandler;
use Modules\Website\Http\Requests\SupportFormRequest;
use Modules\Website\Mail\SupportMail;

final class SupportController extends Controller
{
    public function __construct(
        private readonly CreateTicketHandler $createTicketHandler,
        private readonly GetSettingByKeyHandler $getSettingByKeyHandler,
    ) {}

    public function show()
    {
        return view('website::support');
    }

    public function submit(SupportFormRequest $request): RedirectResponse
    {
        $this->createTicketHandler->handle($request->validated());

        $supportEmail = $this->getSettingByKeyHandler->handle('contact_email', '');

        if ($supportEmail && filter_var($supportEmail, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($supportEmail)->send(new SupportMail(
                    senderName: $request->validated('name'),
                    senderEmail: $request->validated('email'),
                    subjectText: $request->validated('subject'),
                    messageBody: $request->validated('message'),
                ));
            } catch (\Throwable) {
            }
        }

        return back()->with('success', __('website::website.support.success'));
    }
}
