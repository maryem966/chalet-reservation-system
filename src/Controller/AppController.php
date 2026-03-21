<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\Locator\LocatorAwareTrait;

class AppController extends Controller
{
    use LocatorAwareTrait;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        // Décommente si besoin de protection des formulaires
        // $this->loadComponent('FormProtection');
    }
}
