<?php
/**
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 *
 * @author Matt Croft <matt.croft@reflectdigital.co.uk>
 * @copyright 2016 Matt Croft <matt.croft@reflectdigital.co.uk>
 */
namespace Flux\Conduit;

class Container
{
    /**
     * @var \Illuminate\Support\Collection|Task[]
     */
    protected $tasks;

    /**
     * @return \Illuminate\Support\Collection|Task[]
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param \Illuminate\Support\Collection $tasks
     *
     * @return Container
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;

        return $this;
    }

    /**
     * Container constructor.
     *
     * @param array $tasks
     */
    public function __construct($tasks)
    {
        $this->tasks = collect($tasks);
    }
}
