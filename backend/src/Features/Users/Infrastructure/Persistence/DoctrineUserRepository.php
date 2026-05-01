<?php

namespace App\Features\Users\Infrastructure\Persistence;

use App\Domain\Users\Aggregates\User;
use App\Domain\Users\Repositories\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(
        ManagerRegistry                              $registry,
        private readonly UserPasswordHasherInterface $passwordHasher,
    )
    {
        parent::__construct($registry, UserOrm::class);
    }

    public function findByEmail(string $email): ?User
    {
        $orm = $this->findOneBy(['email' => $email]);

        return $orm ? UserMapper::toDomain($orm) : null;
    }

    public function save(User $aggregate): void
    {
        $orm = $this->find($aggregate->id->value) ?? new UserOrm();
        $orm = UserMapper::toOrm($aggregate, $orm);
        $this->getEntityManager()->persist($orm);
        $this->getEntityManager()->flush();
    }

    public function register(User $aggregate, string $password): void
    {
        $orm = $this->find($aggregate->id->value) ?? new UserOrm();
        $orm = UserMapper::toOrm($aggregate, $orm);
        $orm->password = $this->passwordHasher->hashPassword($orm, $password);

        $this->getEntityManager()->persist($orm);
        $this->getEntityManager()->flush();
    }
}
