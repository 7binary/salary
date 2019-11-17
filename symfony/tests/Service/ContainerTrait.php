<?php

namespace App\Tests\Service;

use App\Kernel;
use Symfony\Component\DependencyInjection\ContainerInterface;

trait ContainerTrait
{
    private function getContainer(): ContainerInterface
    {
        $kernel = new Kernel('dev', true);
        $kernel->boot();

        return $kernel->getContainer();
    }
}
