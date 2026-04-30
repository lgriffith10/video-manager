<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class BaseIntegrationTestCase extends KernelTestCase
{
    protected ContainerInterface $container;
    protected EntityManagerInterface $entityManager;

    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();

        $this->container = self::getContainer();
        $this->entityManager = $this->container->get(EntityManagerInterface::class);
    }

    protected function getService(string $serviceId): object
    {
        return $this->container->get($serviceId);
    }

//    protected function as(Uuid $id): void
//    {
//        $user = $this->container->get(UserRepository::class)->findOneBy(['id' => $id]);
//
//        $token = new UsernamePasswordToken($user, 'api', $user->getRoles());
//        $this->container->get('security.token_storage')->setToken($token);
//    }

    protected function persistAndFlush(object ...$entities): void
    {
        foreach ($entities as $entity) {
            $this->entityManager->persist($entity);
        }
        $this->entityManager->flush();
    }

    protected function refresh(object $entity): void
    {
        $this->entityManager->refresh($entity);
    }

    protected function clear(): void
    {
        $this->entityManager->clear();
    }
}
