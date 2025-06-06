<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function send(string $email, string $nome, string $link): bool
    {
        try {
            Mail::to($email)->send(new EmailNotification($nome, $link));
            return true;
        } catch (\Exception $e) {
            Log::error("Erro ao enviar e-mail" . $e->getMessage());
            return false;
        }
    }
}
