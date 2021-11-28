<?php

declare(strict_types=1);

namespace App\Client;

class Curl
{
    /**
     * Send post request to the provided URL
     *
     * @param string $url Request URL
     * @param string|false $postBody Post body
     * @param array<string, string> $options Request options at this moment just content-type is supported.
     *
     * @return array<int, mixed> Response in format [response code, response body]
     */
    public function post(string $url, string|false $postBody, array $options = []): array
    {
        $curlHandle = curl_init($url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postBody);

        if (array_key_exists('content-type', $options)) {
            curl_setopt(
                $curlHandle,
                CURLOPT_HTTPHEADER,
                [
                    'Content-Type:' . $options['content-type']
                ]
            );
        }

        $httpBody = curl_exec($curlHandle);
        $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);

        curl_close($curlHandle);

        return [$httpCode, $httpBody];
    }
}
