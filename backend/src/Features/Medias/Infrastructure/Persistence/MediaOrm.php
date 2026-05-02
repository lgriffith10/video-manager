<?php

namespace App\Features\Medias\Infrastructure\Persistence;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'medias')]
class MediaOrm
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid')]
    public string $id;

    #[ORM\Column(type: 'string', length: 255)]
    public string $name;

    #[ORM\Column(type: 'string', length: 100)]
    public string $mimeType;

    #[ORM\Column(type: 'string')]
    public string $storagePath;

    #[ORM\Column(type: 'string', length: 50)]
    public string $status;
}
