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
     * The output from the task executed.
     *
     * @var array
     */
    protected $output;

    /**
     * The timeout for the function.
     *
     * @var int
     */
    protected $timeout;

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
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param array $output
     *
     * @return Task
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * @param $output
     *
     * @return $this
     */
    public function appendOutput($output)
    {
        $this->output[] = $output;

        return $this;
    }

    /**
     * Get the current timeout for the Task.
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set the timeout.
     *
     * @param int $timeout
     *
     * @return Task
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Create a new Task instance.
     *
     * @param array  $hosts
     * @param string $user
     * @param string $script
     * @param int    $timeout
     */
    public function __construct(array $hosts, $user, $script, $timeout = null)
    {
        $this->user = $user;
        $this->hosts = $hosts;
        $this->script = $script;
        $this->timeout = $timeout;
    }
}
