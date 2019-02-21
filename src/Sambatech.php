<?php

namespace FocusConcursos\SambatechLaravel;


class Sambatech
{
    private $pid;

    private $token;

    public function __construct(string $pid, string $token)
    {
        $this->pid = $pid;
        $this->token = $token;
    }

    public function upload(string $path, array $metadata = []): string
    {
        return '';
    }

    public function dumpConnection(): array
    {
        return [
            'pid' => $this->pid,
            'token' => $this->token
        ];
    }
}
