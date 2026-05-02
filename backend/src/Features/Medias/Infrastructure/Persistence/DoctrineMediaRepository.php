<?php

namespace App\Features\Medias\Infrastructure\Persistence;

use App\Domain\Medias\Aggregates\Media;
use App\Domain\Medias\Repositories\MediaRepositoryInterface;
use App\Domain\Medias\ValueObjects\MediaId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineMediaRepository extends ServiceEntityRepository implements MediaRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediaOrm::class);
    }

    public function save(Media $aggregate): void
    {
        $orm = $this->find($aggregate->id->value) ?? new MediaOrm();
        $orm = MediaMapper::toOrm($aggregate, $orm);
        $this->getEntityManager()->persist($orm);
        $this->getEntityManager()->flush();
    }

    public function findById(MediaId $id): ?Media
    {
        $orm = $this->find($id->value);

        return $orm ? MediaMapper::toDomain($orm) : null;
    }
}
