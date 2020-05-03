<?php

namespace App\Custom\Email\Services;

use App\Custom\Logging\AppLog;
use Illuminate\Support\Facades\Mail;

class EmailService {

    public function __construct() {
    }

    public function sendEmail($senderName, $senderEmail, $message) {
        try {
            $data = [
                'to' => config('custom.mail.contact_email'),
                'subject' => config('custom.mail.contact_subject'),
                'fromEmail' => $senderEmail,
                'fromName' => $senderName,
                'content' => $message
            ];

            Mail::send('pages.contact._email', $data, function ($m) use ($data) {
                $m->subject($data['subject']);
                $m->from($data['fromEmail'], $data['fromName']);
                $m->to($data['to']);
                $m->replyTo($data['fromEmail']);
            });

            $failures = Mail::failures();

            if(count($failures) > 0){

                foreach ($failures as $failure) {
                    AppLog::errorMessage("$failure");
                }
                return false;
            }

            return true;

        }catch (\Exception $e) {
            AppLog::errorMessageException("error sending email", $e);
            return false;
        }

    }

}
