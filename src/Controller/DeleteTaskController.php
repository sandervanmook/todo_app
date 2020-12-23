<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TaskRepository;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DeleteTaskController extends AbstractController
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @Route("/task/delete/{id}", name="task_delete")
     */
    public function delete($id): Response
    {
        try {
            Assertion::numeric($id);
        } catch (AssertionFailedException $e) {
            return new Response($e->getMessage());
        }

        if ($task = $this->taskRepository->find($id)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();

            return new Response(sprintf('Task with id %d successfully deleted', $id), 200);
        } else {
            return new Response(sprintf('Could not find task with id %d', $id), 404);
        }
    }
}