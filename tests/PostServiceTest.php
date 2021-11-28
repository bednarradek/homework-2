<?php

namespace Tests;

use App\Client\Curl;
use App\PostService;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class PostServiceTest extends TestCase
{
    public function testSuccessCreatePost(): void
    {
        $except = '1';
        $jsonResponse = ['id' => 1];

        $curlMock = $this->getMockBuilder(Curl::class)
            ->onlyMethods(['post'])
            ->getMock();

        $curlMock->expects($this->any())
            ->method('post')
            ->will(
                $this->returnValue([
                    201,
                    json_encode($jsonResponse)
                ])
            );

        $postService = new PostService($curlMock);

        $actual = $postService->createPost([
            'name' => 'John',
            'surname' => 'Deer'
        ]);

        $this->assertEquals($except, $actual);
    }

    public function testPostCouldNotBeCreated(): void
    {
        $this->expectException(RuntimeException::class);

        $jsonResponse = ['id' => 1];

        $curlMock = $this->getMockBuilder(Curl::class)
            ->onlyMethods(['post'])
            ->getMock();

        $curlMock->expects($this->any())
            ->method('post')
            ->will(
                $this->returnValue([
                    300,
                    json_encode($jsonResponse)
                ])
            );

        $postService = new PostService($curlMock);

        $postService->createPost([
            'name' => 'John',
            'surname' => 'Deer'
        ]);
    }

    public function testMissingIdInResponse(): void
    {
        $this->expectException(RuntimeException::class);

        $jsonResponse = ['ids' => 1];

        $curlMock = $this->getMockBuilder(Curl::class)
            ->onlyMethods(['post'])
            ->getMock();

        $curlMock->expects($this->any())
            ->method('post')
            ->will(
                $this->returnValue([
                    201,
                    json_encode($jsonResponse)
                ])
            );

        $postService = new PostService($curlMock);

        $postService->createPost([
            'name' => 'John',
            'surname' => 'Deer'
        ]);
    }
}
