<?php

namespace glen\PimpleConsoleApplication\ServiceProvider;

use glen\PimpleConsoleApplication\PimpleConsoleApplication;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConsoleCommandsProvider implements ServiceProviderInterface
{
    /** @var PimpleConsoleApplication */
    private $console;

    public function __construct(PimpleConsoleApplication $console)
    {
        $this->console = $console;
    }

    public function register(Container $app)
    {
        $app['console'] = $this->console;

        $this->console->addCommands($this->getCommands());
    }

    /**
     * @return array
     */
    protected function getCommands()
    {
        return array();
    }
}
