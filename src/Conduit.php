<?php

namespace Flux;

use Flux;
use Flux\Conduit\Container;
use Flux\Conduit\Task;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Output\OutputInterface;

class Conduit
{

    /** @var Container */
    protected $container;

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param Container $container
     *
     * @return $this
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * Conduit constructor.
     *
     * @param $container
     */
    public function __construct( $container )
    {
        $this->container = $container;
    }

    public function execute()
    {

        $tasks = $this->getContainer()->getTasks();

        $connection = new Conduit\Connection\Shell;
        $tasks->each(function($task) use($connection) {
            $connection->run($task);
        });
    }

}