<?php
/**
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 *
 * @author Matt Croft <matt.croft@reflectdigital.co.uk>
 * @copyright 2016 Matt Croft <matt.croft@reflectdigital.co.uk>
 */
namespace Flux\Conduit;

use Symfony\Component\Process\Process;

abstract class Connection
{
    /**
     * Run the given task over SSH.
     *
     * @param \Flux\Conduit\Task $task
     * @param \Closure           $callback
     */
    abstract public function run(Task $task, \Closure $callback = null);

    /**
     * Run the given script on the given host.
     *
     * @param string             $host
     * @param \Flux\Conduit\Task $task
     *
     * @return int
     */
    protected function getProcess($host, Task $task)
    {
        if (in_array($host, ['local', 'localhost', '127.0.0.1'])) {
            $process = new Process($task->script);
        } else {
            $delimiter = 'EOF-FLUX-CONDUIT';

            $process = new Process(
                "ssh $host 'bash -se' << \\$delimiter".PHP_EOL
                .'set -e'.PHP_EOL
                .$task->script.PHP_EOL
                .$delimiter
            );
        }

        return [$host, $process->setTimeout($task->getTimeout())];
    }

    /**
     * Gather the cumulative exit code for the processes.
     *
     * @param array $processes
     *
     * @return int
     */
    protected function gatherExitCodes(array $processes)
    {
        $code = 0;

        foreach ($processes as $process) {
            $code = $code + $process->getExitCode();
        }

        return $code;
    }
}
