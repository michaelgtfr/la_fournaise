<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2021
 * Time: 21:29
 */

namespace App\Mailer;


use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class RegisterMailer
{
    public function contactMailer(MailerInterface $mailer, $from, User $user, $host)
    {
        $email = (new TemplatedEmail())
            ->From($user->getEmail())
            ->to($from)
            ->subject('Création de votre compte sur La fournaise')
            ->htmlTemplate('mailer/registerMailer.html.twig')
            ->context([
                'user' => $user,
                'host' => $host,
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