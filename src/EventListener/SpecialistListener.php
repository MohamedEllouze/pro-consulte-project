<?php

namespace App\EventListener;

use App\Entity\Mail;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\Specialist;
use DateTime;

class SpecialistListener
{
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Specialist) {
            return;
        }
        $subject = "Bienvenue sur notre plateforme";
        $content = "Bonjour " . $entity->getFirstName() . ",\n\n"
            . "Votre compte psychologue a été créé avec succès.\n"
            . "Vous pouvez maintenant vous connecter à votre espace professionnel.\n\n"
            . "Cordialement,\nL'équipe.";

        $mail = (new Mail())
            ->setSubject($subject)
            ->setContent($content)
            ->setDate(new DateTime());

        $args->getObjectManager()->persist($mail);
        $args->getObjectManager()->flush();
    }
}
