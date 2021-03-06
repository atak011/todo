<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $time;

    /**
     * @ORM\Column(type="smallint")
     */
    private $difficulty;

    /**
     * @ORM\ManyToOne(targetEntity=Developer::class, inversedBy="tasks")
     */
    private $assigned_developer;

    /**
     * @ORM\Column(type="smallint",nullable=true)
     */
    private $assigned_week;

    /**
     * @ORM\Column(type="smallint")
     */
    private $effort_point;

    public function __construct($name,$time,$difficulty)
    {
        $this->name = $name;
        $this->time = $time;
        $this->difficulty = $difficulty;
        $this->effort_point = $time*$difficulty;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getAssignedDeveloper(): ?Developer
    {
        return $this->assigned_developer;
    }

    public function setAssignedDeveloper(?Developer $assigned_developer): self
    {
        $this->assigned_developer = $assigned_developer;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssignedWeek()
    {
        return $this->assigned_week;
    }

    /**
     * @param mixed $assigned_week
     */
    public function setAssignedWeek($assigned_week): void
    {
        $this->assigned_week = $assigned_week;
    }

    /**
     * @return mixed
     */
    public function getEffortPoint()
    {
        return $this->effort_point;
    }

    /**
     * @param mixed $effort_point
     */
    public function setEffortPoint($effort_point): void
    {
        $this->effort_point = $effort_point;
    }
}
