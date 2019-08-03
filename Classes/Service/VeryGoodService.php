<?php
namespace DanielGoerz\DiExamples\Service;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

class VeryGoodService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function hasLogger(): bool
    {
        return $this->logger instanceof LoggerInterface;
    }
}
