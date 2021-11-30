<?php

namespace Tests;

use App\Client\Curl;
use App\PostService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class PostServiceTest extends TestCase
{
    /** @var Curl&MockObject  */
    private mixed $curlMock;
    private PostService $postService;

    protected function setUp(): void
    {
        $this->curlMock = $this->getMockBuilder(Curl::class)
            ->onlyMethods(['post'])
            ->getMock();

        $this->postService = new PostService($this->curlMock);
    }

    protected function setReturnValueForCurlMock(int $code, string|false $response): void
    {
        $this->curlMock->expects($this->any())
            ->method('post')
            ->will(
                $this->returnValue([
                    $code,
                    $response
                ])
            );
    }

    public function testSuccessCreatePost(): void
    {
        $except = 1;

        $this->setReturnValueForCurlMock(201, json_encode(['id' => 1]));

        $actual = $this->postService->createPost([
            'name' => 'John',
            'surname' => 'Deer'
        ]);

        $this->assertEquals($except, $actual);
    }

    public function testPostCouldNotBeCreated(): void
    {
        $this->expectException(RuntimeException::class);

        $this->setReturnValueForCurlMock(300, json_encode(['id' => 1]));

        $this->postService->createPost([
            'name' => 'John',
            'surname' => 'Deer'
        ]);
    }

    public function testMissingIdInResponse(): void
    {
        $this->expectException(RuntimeException::class);

        $this->setReturnValueForCurlMock(201, json_encode(['ids' => 1]));

        $this->postService->createPost([
            'name' => 'John',
            'surname' => 'Deer'
        ]);
    }
}
