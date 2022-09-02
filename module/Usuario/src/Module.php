<?php

declare(strict_types=1);

namespace Usuario;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }
}
