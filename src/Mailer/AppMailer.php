<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 24/08/2021
 * Time: 15:07
 */

namespace App\Mailer;


use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class AppMailer
{
    public function contactMailer(MailerInterface $mailer, $form, $to, Contact $contact)
    {
        $email = (new TemplatedEmail())
            ->From($form)
            ->to($to)
            ->subject('Nouveau message de '. $contact->getUsername())
            ->htmlTemplate('mailer/contactMailer.html.twig')
            ->context([
                'contact' => $contact,
            ])
        ;
        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            return $e;
        }
        return true;
    }
}