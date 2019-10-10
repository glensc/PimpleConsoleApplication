<?php

namespace glen\PimpleConsoleApplication;

use glen\ConsoleLoggerServiceProvider\ConsoleLoggerServiceProvider;
use glen\ConsoleLoggerServiceProvider\MonologServiceProvider;
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
        $this->registerLogger($this->container);
        $this->registerProviders($this->container);
    }

    /**
     * @param Container $app
     */
    private function registerLogger(Container $app)
    {
        $app->register(new MonologServiceProvider(), array(
            'monolog.name' => $this->getName(),
        ));
        $app->register(new ConsoleLoggerServiceProvider(), array(
            'logger.console_logger.formatter.options' => array(
                'format' => "%start_tag%%level_name%%end_tag% %message%%context%%extra%\n",
            ),
        ));
    }

    /**
     * @override This should be overridden by Application
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
