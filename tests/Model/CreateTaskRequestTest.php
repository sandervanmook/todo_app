<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\CreateTaskRequest;
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class CreateTaskRequestTest extends TestCase
{
    public function testItCanBeCreatedFromValidRequest()
    {
        $requestInput = [
            'name' => 'testname',
            'description' => 'testdescription',
            'dueDate' => '10-10-2020',
        ];

        $request = new Request([], [], [], [], [], [], json_encode($requestInput));
        $createTaskRequest = new CreateTaskRequest(json_decode($request->getContent()));

        $this->assertEquals('testname', $createTaskRequest->getName());
        $this->assertEquals('testdescription', $createTaskRequest->getDescription());
    }

    public function testItThrowsWhenNameIsMissing()
    {
        $request = new Request();

        $this->expectException(AssertionFailedException::class);
        new CreateTaskRequest(json_decode($request->getContent()));
    }
}
