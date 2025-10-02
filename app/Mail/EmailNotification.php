<?php

declare(strict_types = 1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        protected string $nome,
        protected string $link,
        protected ?string $linkFacial = null,
        protected ?string $tipo = null,
        protected ?string $valor_original = null,
        protected ?string $vencimento_original = null,
        protected ?string $tipo_conta = null
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = match ($this->tipo) {
            'boas_vindas'   => "Bem-vindo, {$this->nome}!",
            'delinquencies' => "Inadimplência aberta",
            default         => "Invicta - Inquilino {$this->nome}, falta pouco para finalizar!",
        };

        return new Envelope(subject: $subject);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = match ($this->tipo) {
            'boas_vindas'   => 'emails.boas_vindas',
            'delinquencies' => 'emails.delinquencies',
            default         => 'emails.notify',
        };

        return new Content(
            view: $view,
            with: [
                'nome'                => $this->nome,
                'link'                => $this->link,
                'linkFacial'          => $this->linkFacial,
                'valor_original'      => $this->valor_original,
                'vencimento_original' => $this->vencimento_original,
                'tipo_conta'          => $this->tipo_conta,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
