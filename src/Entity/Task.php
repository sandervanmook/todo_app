<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\CreateTaskRequest;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $finished = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTime $dueDate;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $creationDate;

    private function __construct()
    {
    }

    static public function fromAPI(CreateTaskRequest $createTaskRequest) : Task
    {
        $task = new Task();
        $task->name = $createTaskRequest->getName();
        $task->description = $createTaskRequest->getDescription();
        $task->dueDate = $createTaskRequest->getDueDate();
        $task->creationDate = new \DateTimeImmutable();

        return $task;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function getDueDate(): ?\DateTime
    {
        return $this->dueDate;
    }

    public function getCreationDate(): \DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }


}