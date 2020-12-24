<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TaskRepository;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/task/{id}", name="task_delete", methods={"DELETE"})
     */
    public function __invoke($id): Response
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

            return new JsonResponse(null, 204);
        } else {
            $errorInformation = [
                'errorMessage' => sprintf('Could not find task with id %d', $id),
            ];
            return new JsonResponse($errorInformation,404);
        }
    }
}
