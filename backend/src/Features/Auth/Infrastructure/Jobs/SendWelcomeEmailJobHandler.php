<?php

namespace App\Features\Auth\Infrastructure\Jobs;

use App\Features\Auth\Application\Jobs\SendWelcomeEmailJob;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler('infrastructure_job.bus')]
final readonly class SendWelcomeEmailJobHandler
{
    public function __construct(
        private MailerInterface $mailer,
    )
    {
    }

    public function __invoke(SendWelcomeEmailJob $job): void
    {
        $email = new Email()
            ->to($job->email)
            ->from('test@test.com')
            ->subject('Bienvenue !')
            ->text('Votre compte a bien été créé.');

        $this->mailer->send($email);
    }
}
