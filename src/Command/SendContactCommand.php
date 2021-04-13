<?php

namespace App\Command;

use App\Service\ContactService;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use App\Repository\ContactRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendContactCommand extends Command
{
    private $contactService;
    private $mailer;
    private $userRepository;
    private $contactRepository;
    protected static $defaultName = 'app:send-contact';

    public function __construct(ContactRepository $contactRepository, UserRepository $userRepository, ContactService $contactService, MailerInterface $mailer)
    {
        $this->contactService = $contactService;
        $this->contactRepository = $contactRepository;
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
        parent::__construct();

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $toSend = $this->contactRepository->findBy(['isSend'=>false]);

        foreach($toSend as $mail){
            $email = (new Email())
            ->from($mail->getEmail())
            ->to('jeannet.julie@gmail.com')
            ->subject('Nouveau message de:' .$mail->getNom() )
            ->text($mail->getMessage());

        $this->mailer->send($email);
        $this->contactService->isSend($mail);

        }

        return Command::SUCCESS;
    }
}
