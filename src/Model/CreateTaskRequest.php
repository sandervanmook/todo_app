<?php

declare(strict_types=1);

namespace App\Model;

use Assert\Assertion;

class CreateTaskRequest
{
    private string $name;
    private ?string $description;
    private ?\DateTime $dueDate;

    public function __construct($requestData)
    {
        Assertion::propertiesExist($requestData, ['name'], 'Name is a mandatory field');
        Assertion::notBlank($requestData->name);
        $this->name = $requestData->name;

        if (property_exists($requestData, 'dueDate')) {
            Assertion::date($requestData->dueDate, 'd-m-Y');
            $this->dueDate = new \DateTime($requestData->dueDate) ?: null;
        }

        $this->description = $requestData->description ?: null;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDueDate(): ?\DateTime
    {
        return $this->dueDate;
    }
}
