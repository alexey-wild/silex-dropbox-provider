<?php
namespace DropboxApi\Silex\Provider;

require_once __DIR__.'/DropboxApi.php';

use Silex\Application;
use Silex\ServiceProviderInterface;

class DropboxApiServiceProvider implements ServiceProviderInterface
{
    public $dropboxapi;

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $options = $app['settings']['external_services']['dropbox'];
        $app['vkapi'] = $app->share(function ($options) use ($app) {
            $this->dropboxapi = new DropboxApi($options['id'], $options['secret']);
            return $this->dropboxapi;
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registers
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {}
}