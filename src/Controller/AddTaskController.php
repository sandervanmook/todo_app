<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
use App\Model\CreateTaskRequest;
use Assert\AssertionFailedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddTaskController extends AbstractController
{
    /**
     * @Route("/task/create", name="task_create")
     */
    public function __invoke(Request $request): Response
    {
        $requestData = \json_decode($request->getContent());

        if (0 !== json_last_error()) {
            return new Response(json_last_error_msg(), 400);
        }

        try {
            $createTaskRequest = new CreateTaskRequest($requestData);
        } catch (AssertionFailedException $e) {
            return new Response($e->getMessage(), 400);
        }
        $task = Task::fromAPI($createTaskRequest);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return new Response('Task successfully created', 200);
    }
}
