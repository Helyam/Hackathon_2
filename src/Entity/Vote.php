<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\topics", inversedBy="votes")
     */
    private $topic;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="votes")
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPositif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTopic(): ?topics
    {
        return $this->topic;
    }

    public function setTopic(?topics $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIsPositif(): ?bool
    {
        return $this->isPositif;
    }

    public function setIsPositif(bool $isPositif): self
    {
        $this->isPositif = $isPositif;

        return $this;
    }
}
