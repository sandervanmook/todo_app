<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\CreateTaskRequest;
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class CreateTaskRequestTest extends TestCase
{
    public function test_it_can_be_created_from_valid_request()
    {
        $requestInput = [
            'name' => 'testname',
            'description' => 'testdescription',
            'dueDate' => '10-10-2020',
        ];

        $request = New Request([],[],[],[],[],[],json_encode($requestInput));
        $createTaskRequest = new CreateTaskRequest(json_decode($request->getContent()));

        $this->assertEquals('testname', $createTaskRequest->getName());
        $this->assertEquals('testdescription', $createTaskRequest->getDescription());
    }

    public function test_it_throws_when_name_is_missing()
    {
        $request = New Request();

        $this->expectException(AssertionFailedException::class);
        new CreateTaskRequest(json_decode($request->getContent()));
    }
}
