<?php

namespace glen\PimpleConsoleApplication;

use glen\ConsoleLoggerServiceProvider\ConsoleLoggerServiceProvider;
use glen\ConsoleLoggerServiceProvider\MonologServiceProvider;
use Pimple\Container;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PimpleConsoleApplication extends Application
{
    /** @var Container */
    protected $container;

    /** @var string */
    protected $name = 'UNKNOWN';

    /** @var string */
    protected $version = 'UNKNOWN';

    /** @var bool */
    private $initialized = false;

    public function __construct(Container $app = null)
    {
        parent::__construct($this->name, $this->version);
        $this->container = $app ?: new Container();
    }

    /**
     * Override to use same input and output
     *
     * @param InputInterface|null $input
     * @param OutputInterface|null $output
     * @return int
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $app = $this->getContainer();

        return parent::run($input ?: $app['console.input'], $output ?: $app['console.output']);
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        if ($this->initialized === false) {
            $this->registerLogger($this->container);
            $this->registerProviders($this->container);
            $this->initialized = true;
        }

        return $this->container;
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
            'logger.console_logger.formatter.format' => "%start_tag%%level_name%%end_tag% %message%%context%%extra%\n",
        ));
    }

    /**
     * @override This should be overridden by Application
     * @param Container $app
     */
    protected function registerProviders(Container $app)
    {
    }
}
