<?php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Article;

class GeneratorWebPListener
{
    private string $uploadDir;

    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->generateWebP($args);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->generateWebP($args);
    }

    private function generateWebP(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // Vérifiez si l'entité est celle qui contient l'imagej
        if (!$entity instanceof Article || !$entity->getImageName()) {
            return;
        }

        $originalImagePath = $this->uploadDir . '/' . $entity->getImageName();
        $webpImagePath = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $originalImagePath);
    }
}
