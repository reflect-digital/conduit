<?php

namespace Flux;

use Flux\Conduit\Container;
use Symfony\Component\Process\Process;

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
            $connection->run($task,function ($type, $host, $line) {
                if (starts_with($line, 'Warning: Permanently added ')) {
                    return;
                }

                $this->displayOutput($type, $host, $line);
            });
        });
    }


    /**
     * Display the given output line.
     *
     * @param  int  $type
     * @param  string  $host
     * @param  string  $line
     * @return void
     */
    protected function displayOutput($type, $host, $line)
    {
        $lines = explode("\n", $line);

        foreach ($lines as $line) {
            if (strlen(trim($line)) === 0) {
                return;
            }

            print(trim($line).PHP_EOL);
        }
    }

}