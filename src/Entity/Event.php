<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $subtitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chapo;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity=PictureEvent::class, mappedBy="events")
     */
    private $pictureEvents;

    public function __construct()
    {
        $this->pictureEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getChapo(): ?string
    {
        return $this->chapo;
    }

    public function setChapo(string $chapo): self
    {
        $this->chapo = $chapo;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|PictureEvent[]
     */
    public function getPictureEvents(): Collection
    {
        return $this->pictureEvents;
    }

    public function addPictureEvent(PictureEvent $pictureEvent): self
    {
        if (!$this->pictureEvents->contains($pictureEvent)) {
            $this->pictureEvents[] = $pictureEvent;
            $pictureEvent->setEvents($this);
        }

        return $this;
    }

    public function removePictureEvent(PictureEvent $pictureEvent): self
    {
        if ($this->pictureEvents->removeElement($pictureEvent)) {
            // set the owning side to null (unless already changed)
            if ($pictureEvent->getEvents() === $this) {
                $pictureEvent->setEvents(null);
            }
        }

        return $this;
    }
}
