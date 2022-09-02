<?php

declare(strict_types=1);

namespace Usuario\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
