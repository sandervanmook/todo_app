<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TaskRepository;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ViewTaskController
{
    private TaskRepository $taskRepository;
    private SerializerInterface $serializer;

    public function __construct(TaskRepository $taskRepository, SerializerInterface $serializer)
    {
        $this->taskRepository = $taskRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/task/view/{id}", name="task_view")
     */
    public function __invoke($id): Response
    {
        try {
            Assertion::numeric($id);
        } catch (AssertionFailedException $e) {
            return new Response($e->getMessage());
        }

        if ($task = $this->taskRepository->find($id)) {
            return new JsonResponse($this->serializer->serialize($task, 'json'), 200, [], true);
        } else {
            return new Response(sprintf('Task with id %d not found', $id));
        }
    }
}
