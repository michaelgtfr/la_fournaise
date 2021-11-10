<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 24/08/2021
 * Time: 14:43
 */

namespace App\Treatment;


use App\Entity\ApplicationInformation;
use App\Entity\Contact;
use App\Mailer\AppMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;

class ContactTreatment
{
    public function treatmentAndSendMailer(Contact $contact, MailerInterface $mailer,EntityManagerInterface $em)
    {

        $applicationInformation = $em->getRepository(ApplicationInformation::class)->findAll();
        $contact->setDateCreate(new \DateTime());
        $mailerSend = (new AppMailer())->contactMailer($mailer,$contact->getEmail(), $applicationInformation[0]->getEmailApplication(), $contact);

        return $mailerSend;
    }
}