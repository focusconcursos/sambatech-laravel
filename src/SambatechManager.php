<?php

namespace FocusConcursos\SambatechLaravel;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

class SambatechManager extends AbstractManager
{
    private $factory;

    public function __construct(Repository $config, SambatechFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    public function getFactory(): SambatechFactory
    {
        return $this->factory;
    }

    protected function createConnection(array $config): Sambatech
    {
        return $this->factory->make($config);
    }

    protected function getConfigName(): string
    {
        return 'sambatech';
    }
}
