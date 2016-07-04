<?php
/**
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 *
 * @author Matt Croft <matt.croft@reflectdigital.co.uk>
 * @copyright 2016 Matt Croft <matt.croft@reflectdigital.co.uk>
 */

namespace Flux\Conduit\Connection;

use Flux;
use Flux\Conduit\Task;

class Shell extends Flux\Conduit\Connection
{

    use Flux\Conduit\Interactions\ShellConfigParser;

    /**
     * Run the given task over SSH.
     *
     * @param \Flux\Conduit\Task $task
     * @param \Closure           $callback
     *
     * @return int
     */
    public function run(Task $task, \Closure $callback = null)
    {
        $processes = [];

        $callback = $callback ?: function () {};

        foreach ($task->hosts as $host) {
            $process = $this->getProcess($host, $task);

            $processes[$process[0]] = $process[1];
        }

        foreach ($processes as $host => $process) {
            $process->run(function ($type, $output) use ($host, $callback) {
                $callback($type, $host, $output);
            });
        }

        return $this->gatherExitCodes($processes);
    }
}