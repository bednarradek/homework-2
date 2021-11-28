<?php

declare(strict_types=1);

namespace App;

use App\Client\Curl;
use RuntimeException;

class PostService
{
    /**
     * Http client
     *
     * @var Curl
     */
    private Curl $client;

    /**
     * Constructor
     *
     * @param Curl $client Http client based on CURL
     */
    public function __construct(Curl $client)
    {
        $this->client = $client;
    }

    /**
     * Create post in the remote service
     *
     * @param array<string, string> $postData Post data
     *
     * @return int Id of the post
     */
    public function createPost(array $postData): int
    {
        $response = $this->client->post(
            'https://jsonplaceholder.typicode.com/posts',
            json_encode($postData),
            [
                'content-type' => 'application/json'
            ]
        );

        list($statusCode, $requestBody) = $response;

        if ($statusCode !== 201) {
            throw new RuntimeException('Post could not be created.');
        }

        // For sake of clarity, let's make an assumption, that the result is always valid JSON ;-)
        if (!$requestBody) {
            $requestBody = '{}';
        }
        $requestBody = strval($requestBody);
        $createdPost = json_decode($requestBody, true);

        if (!is_array($createdPost) || !array_key_exists('id', $createdPost)) {
            throw new RuntimeException('An id of article could not be retrieved.');
        }

        return $createdPost['id'];
    }
}
