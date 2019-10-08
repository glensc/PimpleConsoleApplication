<?php

namespace glen\PimpleConsoleApplication;

use ED\Resizer\Command;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConsoleCommandsProvider implements ServiceProviderInterface
{
    /** @var Application */
    private $console;

    public function __construct(Application $console)
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
        return array(
        );
    }
}
