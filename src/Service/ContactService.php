<?php

namespace App\Service;

use App\Entity\Contact;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ContactService
{
    private $manager;
    private $flash;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flash)
    {
        $this->manager = $manager;
        $this->flash = $flash;
    }

    public function persistContact(Contact $contact): void
    {

        $contact->setCreatedAt(new DateTime('now'))
            ->setIsSend(false);
        $this->manager->persist($contact);
        $this->manager->flush();
        $this->flash->add('success', 'Votre message a bien été envoyé');

        // $email = (new Email())
        //     ->from('admin@example.com')
        //     ->to('manager@example.com')
        //     ->subject('Site update just happened!')
        //     ->text('Someone just updated the site. We told them: '.$happyMessage);

        // $this->mailer->send($email);

        // ...

        // return true;
    }

    public function isSend(Contact $contact){
        $contact->setIsSend(true);
        $this->manager->persist($contact);
        $this->manager->flush();
    }
}
