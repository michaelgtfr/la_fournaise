<?php

namespace App\Entity;

use App\Repository\PictureEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PictureEventRepository::class)
 */
class PictureEvent extends AbstractPicture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="pictureEvents")
     */
    private $events;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvents(): ?Event
    {
        return $this->events;
    }

    public function setEvents(?Event $events): self
    {
        $this->events = $events;

        return $this;
    }
}
