<?php

namespace glen\PimpleConsoleApplication;

use Pimple\Container;
use Symfony\Component\Console\Application;

class PimpleConsoleApplication extends Application
{
    /** @var Container */
    protected $container;

    public function __construct(Container $app = null)
    {
        parent::__construct();
        $this->container = $app ?: new Container();
        $this->registerProviders($this->container);
    }

    /**
     * This should be overridden.
     *
     * @param Container $app
     */
    protected function registerProviders(Container $app)
    {
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}
