<?php

declare(strict_types=1);

namespace Usuario;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }
    
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\UsuarioTable::class => function($container) {
                    $tableGateway = $container->get(Model\UsuarioTableGateway::class);
                    return new Model\UsuarioTable($tableGateway);
                },
                Model\UsuarioTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Usuario());
                    return new TableGateway('usuario', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\UsuarioController::class => function($container) {
                    return new Controller\UsuarioController(
                        $container->get(Model\UsuarioTable::class)
                    );
                },
            ],
        ];
    }
    
}
