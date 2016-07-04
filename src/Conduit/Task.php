<?php
/**
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 *
 * @author Matt Croft <matt.croft@reflectdigital.co.uk>
 * @copyright 2016 Matt Croft <matt.croft@reflectdigital.co.uk>
 */

namespace Flux\Conduit;

class Task
{

    /**
     * All of the hosts to run the task on.
     *
     * @var array
     */
    public $hosts = [];

    /**
     * The username the task should be run as.
     *
     * @var string
     */
    public $user;

    /**
     * The script commands.
     *
     * @var string
     */
    public $script;

    /**
     * Indicates if the task should be run in parallel across servers.
     *
     * @var array
     */
    public $parallel;

    /*
    * Asks a user for a confirmation.
    *
    * @var string
    */
    public $confirm;

    /**
     * @return array
     */
    public function getHosts()
    {
        return $this->hosts;
    }

    /**
     * @param array $hosts
     *
     * @return Task
     */
    public function setHosts($hosts)
    {
        $this->hosts = $hosts;

        return $this;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     *
     * @return Task
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * @param string $script
     *
     * @return Task
     */
    public function setScript($script)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * @return array
     */
    public function getParallel()
    {
        return $this->parallel;
    }

    /**
     * @param array $parallel
     *
     * @return Task
     */
    public function setParallel($parallel)
    {
        $this->parallel = $parallel;

        return $this;
    }

    /**
     * @return null
     */
    public function getConfirm()
    {
        return $this->confirm;
    }

    /**
     * @param null $confirm
     *
     * @return Task
     */
    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;

        return $this;
    }

    /**
     * Create a new Task instance.
     *
     * @param  array  $hosts
     * @param  string $user
     * @param  string $script
     * @param bool    $parallel
     * @param null    $confirm
     */
    public function __construct(array $hosts, $user, $script, $parallel = false, $confirm = null)
    {
        $this->user = $user;
        $this->hosts = $hosts;
        $this->script = $script;
        $this->parallel = $parallel;
        $this->confirm = $confirm;
    }

}