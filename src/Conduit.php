<?php

namespace Flux;

use Flux\Conduit\Container;
use Flux\Conduit\Task;
use Illuminate\Support\Collection;

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
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Execute the task container.
     *
     * @param bool $displayOutput
     */
    public function execute($displayOutput = false, \Closure $callback = null)
    {
        $tasks = $this->getContainer()->getTasks();

        $callback = $callback ?: function () {
        };

        $connection = new Conduit\Connection\Shell();
        $tasks->each(function (Task $task, $id) use ($connection, $displayOutput, $callback) {
            $connection->run($task, function ($type, $host, $line) use ($task, $displayOutput) {
                if (starts_with($line, 'Warning: Permanently added ')) {
                    return;
                }

                $task->appendOutput($this->formatOutput($line));

                if ($displayOutput) {
                    $this->displayOutput($type, $host, $line);
                }
            });

            call_user_func($callback, $id);
        });
    }

    /**
     * Format the output.
     *
     * @param string $output
     *
     * @return Collection
     */
    protected function formatOutput($output)
    {
        $lines = collect(explode("\n", $output));

        return $lines->transform(function ($line) {
            return trim($line);
        })->reject(function ($line) {
            return strlen(trim($line)) === 0;
        });
    }

    /**
     * Display the given output line.
     *
     * @param int    $type
     * @param string $host
     * @param string $line
     *
     * @return void
     */
    protected function displayOutput($type, $host, $line)
    {
        $this->formatOutput($line)->each(function ($line) {
            echo trim($line).PHP_EOL;
        });
    }
}
