<?php

namespace App\Features\Users\Infrastructure\Persistence;

use App\Domain\Users\Aggregates\UserAggregate;
use App\Domain\Users\Repositories\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserOrm::class);
    }

    public function findByEmail(string $email): ?UserAggregate
    {
        $orm = $this->findOneBy(['email' => $email]);

        return $orm ? UserMapper::toDomain($orm) : null;
    }

    public function save(UserAggregate $aggregate): void
    {
        $orm = $this->find($aggregate->id->value) ?? new UserOrm();
        $orm = UserMapper::toOrm($aggregate, $orm);
        $this->getEntityManager()->persist($orm);
        $this->getEntityManager()->flush();
    }

    public function register(UserAggregate $aggregate, string $password): void
    {
        $orm = $this->find($aggregate->id->value) ?? new UserOrm();
        $orm = UserMapper::toOrm($aggregate, $orm);
        $orm->password = $password;
        
        $this->getEntityManager()->persist($orm);
        $this->getEntityManager()->flush();
    }
}
