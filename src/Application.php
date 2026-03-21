<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;

class Application extends BaseApplication
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        parent::bootstrap();

        if (PHP_SAPI !== 'cli') {
            FactoryLocator::add(
                'Table',
                (new TableLocator())->allowFallbackClass(false)
            );
        }
        Configure::write('DebugKit.forceDisableToolbar', true);

    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        // Middleware pour la gestion des erreurs
        $middlewareQueue->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this));

        // Middleware pour la gestion des assets (CSS, JS, images)
        $middlewareQueue->add(new AssetMiddleware([
            'cacheTime' => Configure::read('Asset.cacheTime'),
        ]));

        // Middleware pour la gestion du routing
        $middlewareQueue->add(new RoutingMiddleware($this));

        // Middleware pour parser les requêtes POST/PUT/PATCH en array
        $middlewareQueue->add(new BodyParserMiddleware());

        // Middleware CSRF Protection
        $csrf = new CsrfProtectionMiddleware([
            'httponly' => true,
        ]);
        $middlewareQueue->add($csrf);

        return $middlewareQueue;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/5/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
        // Define your dependency injections here if needed
    }
}
