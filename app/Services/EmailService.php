<?php

declare(strict_types = 1);

namespace App\Services;

use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function send(string $email, string $nome, string $link, string $linkFacial, $type = null, $valorOriginal = null, $vencimentoOriginal = null, $tipoConta = null): bool
    {
        try {
            $cc = [
                'atendimento@invictafiancas.com.br',
                'corretor@invictafiancas.com.br',
                'administracao@invictafiancas.com.br',
                'juridico@invictafiancas.com.br'
            ];

            Mail::to($email)
                ->cc($cc) // cópia para os três
                // ->bcc($cc) // se preferir cópia oculta, use bcc
                ->send(new EmailNotification($nome, $link, $linkFacial, $type, $valorOriginal, $vencimentoOriginal, $tipoConta));

            return true;
        } catch (\Exception $e) {
            Log::error("Erro ao enviar e-mail" . $e->getMessage());

            return false;
        }
    }
}
