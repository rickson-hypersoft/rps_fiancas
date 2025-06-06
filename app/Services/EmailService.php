<?php

declare(strict_types = 1);

namespace App\Services;

use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function send(array $data, string $destination): bool
    {
        try {
            Mail::to($destination)->send(new EmailNotification($data));

            return true;
        } catch (\Exception $e) {
            Log::error("Erro ao enviar e-mail" . $e->getMessage());

            return false;
        }
    }
}
