<?php

namespace FocusConcursos\SambatechLaravel;


use FocusConcursos\SambatechLaravel\Exception\CannotGenerateUploadUrlException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Sambatech
{
    protected $sambaVideosBaseUrl = 'https://api.sambavideos.sambatech.com/v1';

    protected $pid;

    protected $token;

    protected $http;

    /**
     * Sambatech constructor.
     *
     * @param string $pid Project ID
     * @param string $token Access token
     */
    public function __construct(string $pid, string $token)
    {
        $this->pid = $pid;
        $this->token = $token;
        $this->http = new Client();
    }

    /**
     * Get the project id and token as an array
     *
     * @return array
     */
    public function dumpConnection(): array
    {
        return [
            'pid' => $this->pid,
            'token' => $this->token
        ];
    }

    /**
     * @param string $path Path to the target video file on the server
     * @param array $metadata Parameters of the video, like name and description
     * @return string The url of the video
     * @throws CannotGenerateUploadUrlException
     */
    public function upload(string $path, array $metadata = []): string
    {
        $uploadUrl = $this->generateUploadUrl();

        return 'dummy';
    }

    protected function generateUploadUrl(): string
    {
        $url = "{$this->sambaVideosBaseUrl}/medias";

        try {
            $res = $this->http->request('POST', $url, [
                'query' => [
                    'access_token' => $this->token,
                    'pid' => $this->pid
                ],
                'body' => [
                    'qualifier' => 'VIDEO'
                ]
            ]);
        } catch (ClientException $e) {
            throw new CannotGenerateUploadUrlException();
        }

        $body = json_decode($res->getBody());

        return $body['uploadUrl'];
    }
}
