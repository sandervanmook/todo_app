<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListTasksController extends AbstractController
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @Route("/task/viewlist", name="task_list")
     */
    public function __invoke(): JsonResponse
    {
        $tasks = $this->taskRepository->findAllAsArray();

        return new JsonResponse($tasks);
    }
}
