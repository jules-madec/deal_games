<?php
// src/EventSubscriber/CategorySubscriber.php

namespace App\EventSubscriber;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CategorySubscriber implements EventSubscriberInterface
{
    public function __construct(private EntityManagerInterface $em) {}

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::REQUEST => 'onKernelRequest'];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) return;

        $repo = $this->em->getRepository(Category::class);

        $categories = ['Consoles', 'Jeux', 'Accessoires'];

        foreach ($categories as $nom) {

            if (!$repo->findOneBy(['name' => $nom])) {
                $category = new Category();
                $category->setName($nom);
                $this->em->persist($category);
            }
        }

        $this->em->flush();
    }
}
