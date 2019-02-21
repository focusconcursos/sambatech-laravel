<?php

namespace FocusConcursos\SambatechLaravel;

use InvalidArgumentException;


class SambatechFactory
{
    public function make(array $config): Sambatech
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    protected function getConfig(array $config): array
    {
        $keys = ['pid', 'access_token'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['pid', 'access_token']);
    }

    protected function getClient(array $config): Sambatech
    {
        return new Sambatech(
            $config['pid'],
            $config['access_token']
        );
    }
}
