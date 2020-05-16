<?php

namespace App\Http\Controllers;

use App\Custom\HttpMessages\Services\HttpMessagesService;
use App\Custom\Logging\AppLog;
use App\Entities\ContactEntity;
use App\FormBuilders\ContactFormBuilder;
use App\Http\Requests\ContactRequest;
use App\Custom\Email\Services\EmailService;

class ContactController extends Controller {

    /**
     * @var HttpMessagesService
     */
    private $messagesService;

    /**
     * @var EmailService
     */
    private $mailService;

    /**
     * @var ContactFormBuilder
     */
    private $formBuilder;

    public function __construct(
        ContactFormBuilder $formBuilder,
        HttpMessagesService $messagesService,
        EmailService $mailService) {

        $this->messagesService = $messagesService;
        $this->mailService = $mailService;
        $this->formBuilder = $formBuilder;
    }

    public function send(ContactRequest $request) {
        try {
            $outcome = $this->messagesService->createResponseWithGenericError();

            /** @var ContactEntity $contactEntity */
            $contactEntity = $this->formBuilder->createEntityFromRequest($request);

            if ($this->formBuilder->isAValidCaptchaRequest($request)) {
                $isSent = $this->mailService->sendEmail(
                    $contactEntity->name,
                    $contactEntity->email,
                    $contactEntity->telephone,
                    $contactEntity->message);
                if ($isSent) {
                    $request->session()->flash('resetForm', true);
                    $outcome = $this->messagesService->createSuccessResponse(__('page-contact.messages.send-success'));
                }
            }

            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->messagesService->createResponseWithGenericError();
        }
    }
}
