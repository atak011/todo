<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeveloperRepository::class)
 */
class Developer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $work_per_time;

    /**
     * @ORM\Column(type="smallint",nullable=true)
     */
    private $weekly_working_hours;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="assigned_developer")
     */
    private $tasks;


    public function __construct()
    {
        $this->tasks = new ArrayCollection();
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

    public function getWorkPerTime(): ?int
    {
        return $this->work_per_time;
    }

    public function setWorkPerTime(int $work_per_time): self
    {
        $this->work_per_time = $work_per_time;

        return $this;
    }

    public function getWeeklyWorkingHours(): ?int
    {
        return $this->weekly_working_hours;
    }

    public function setWeeklyWorkingHours(int $weekly_working_hours): self
    {
        $this->weekly_working_hours = $weekly_working_hours;

        return $this;
    }

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setAssignedDeveloper($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->contains($task)) {
            $this->tasks->removeElement($task);
            // set the owning side to null (unless already changed)
            if ($task->getAssignedDeveloper() === $this) {
                $task->setAssignedDeveloper(null);
            }
        }

        return $this;
    }
}
