<?php

namespace FocusConcursos\SambatechLaravel;


use FocusConcursos\SambatechLaravel\Exception\CannotGenerateUploadUrlException;
use FocusConcursos\SambatechLaravel\Exception\CannotUpdateMetadataException;
use FocusConcursos\SambatechLaravel\Exception\CannotUploadFileException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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
     * @return string The id of the video
     * @throws CannotGenerateUploadUrlException
     * @throws CannotUploadFileException
     * @throws CannotUpdateMetadataException
     */
    public function upload(string $path, array $metadata): string
    {
        $mediaMetadata = $this->generateMetadata();
        $this->performUpload($mediaMetadata['upload_url'], $path);
        $this->updateMediaMetadata($mediaMetadata['upload_url'], $metadata);

        return $metadata['id'];
    }

    /**
     * Create a media and receive an upload URL.
     *
     * @return array
     * @throws CannotGenerateUploadUrlException
     */
    protected function generateMetadata(): array
    {
        $url = "{$this->sambaVideosBaseUrl}/medias";

        try {
            $res = $this->http->request('POST', $url, [
                'query' => [
                    'access_token' => $this->token,
                    'pid' => $this->pid
                ],
                'json' => [
                    'qualifier' => 'VIDEO'
                ]
            ]);
        } catch (GuzzleException $e) {
            throw new CannotGenerateUploadUrlException($e);
        }

        $body = json_decode($res->getBody());

        return [
            'id' => $body->id,
            'upload_url' => $body->uploadUrl
        ];
    }

    /**
     * Perform the file upload itself.
     *
     * @param string $url
     * @param string $filepath
     * @throws CannotUploadFileException
     */
    protected function performUpload(string $url, string $filepath): void
    {
        try {
            $this->http->request('POST', $url, [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($filepath, 'r')
                    ]
                ]
            ]);
        } catch (GuzzleException $e) {
            throw new CannotUploadFileException($e);
        }
    }

    /**
     * Update media metadata
     *
     * @param string $url URL to the target video file on the server
     * @param array $metadata Attributes of the video, (title, description, shortDescription, tags:[tag1, tag2])
     * @throws CannotUpdateMetadataException
     */
    protected function updateMediaMetadata(string $url, array $metadata): void
    {
        try {
            $this->http->request('PUT', $url, [
                'query' => [
                    'access_token' => $this->token,
                    'pid' => $this->pid
                ],
                'json' => [
                    $metadata
                ]
            ]);
        } catch (GuzzleException $e) {
            throw new CannotUpdateMetadataException($e);
        }
    }
}
