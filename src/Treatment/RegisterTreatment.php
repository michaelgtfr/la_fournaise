<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2021
 * Time: 20:37
 */

namespace App\Treatment;


use App\Entity\ApplicationInformation;
use App\Entity\User;
use App\Mailer\RegisterMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterTreatment
{
    public function treatmentAndSendMailer(User $user, MailerInterface $mailer, EntityManagerInterface $em,
                                           UserPasswordEncoderInterface $passwordEncoder, Session $session, $host)
    {
        $userExist = $em->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);

        if (!$userExist) {
            if($user->getConfirmationPassword() == $user->getPassword()) {
                $key = md5(microtime(true)*100000);

                $user->setConfirmationAccount(0);
                $user->setRoles(['ROLE_USER']);
                $user->setConfirmationKey($key);
                $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
                $em->persist($user);
                $em->flush();

                $applicationInformation = $em->getRepository(ApplicationInformation::class)->findAll();
                $mailerSend = (new RegisterMailer())->contactMailer($mailer, $applicationInformation[0]->getEmailApplication(), $user, $host);

                if($mailerSend) {
                    return $session->getFlashBag()->add(
                        'success',
                        'Votre compte à été créé.'
                    );
                }
                return $session->getFlashBag()->add(
                    'error',
                    'Un problème est survenu, possible que votre compte à été créé'
                );
            }
            return $session->getFlashBag()->add(
                'error',
                'Vos mots de passe ne ce ressemble pas.'
            );
        }
        return $session->getFlashBag()->add(
            'error',
            'un compte existe déjà à cette adresse email.'
        );
    }

}