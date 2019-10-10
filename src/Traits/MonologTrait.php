<?php

namespace glen\PimpleConsoleApplication\Traits;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

trait MonologTrait
{
    use LoggerTrait;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = [])
    {
        $this->logger->log($level, $message, $context);
    }
}
