<?php

namespace glen\PimpleConsoleApplication\Command;

use glen\PimpleConsoleApplication\PimpleConsoleApplication;
use glen\PimpleConsoleApplication\Traits\LoggerTrait;
use Pimple\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    use LoggerTrait;

    const DEBUG = OutputInterface::VERBOSITY_DEBUG;
    const VERBOSE = OutputInterface::VERBOSITY_VERBOSE;
    const VERY_VERBOSE = OutputInterface::VERBOSITY_VERY_VERBOSE;

    /** @var InputInterface */
    protected $input;

    /** @var OutputInterface */
    protected $output;

    /** @var string */
    protected $commandName;

    /** @var string[] */
    protected $commandAliases;

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->input = $input;

        $app = $this->getContainer();
        $this->logger = $app['logger'];
    }

    /**
     * Interacts with the user.
     *
     * This method is executed before the InputDefinition is validated.
     * This means that this is the only place where the command can
     * interactively ask for values of missing required arguments.
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
    }

    /**
     * Writes a message to the output and adds a newline at the end.
     *
     * @param string|array $messages The message as an array of lines of a single string
     * @param int $options A bitmask of options (one of the OUTPUT or VERBOSITY constants), 0 is considered the same as self::OUTPUT_NORMAL | self::VERBOSITY_NORMAL
     */
    protected function writeln($messages, $options = 0)
    {
        $this->output->writeln($messages, $options);
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        /** @var PimpleConsoleApplication $application */
        $application = $this->getApplication();

        return $application->getContainer();
    }
}
