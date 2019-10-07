<?php

namespace glen\PimpleConsoleApplication;

use Pimple\Container;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    /** @var Container */
    protected $container;

    public function __construct()
    {
        parent::__construct();
        $this->container = $this->createContainer();
    }

    /**
     * @return Container
     */
    protected function createContainer()
    {
        $app = new Container();
        $this->registerProviders($app);

        return $app;
    }

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
