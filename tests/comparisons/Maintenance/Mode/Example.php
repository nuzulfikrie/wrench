<?php
namespace App\Maintenance\Mode;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Wrench\Mode\Mode;

/**
 * Example Maintenance Mode
 */
class Example extends Mode
{

    /**
     * Array containing the default config value for your maintenance mode
     * This value can be overridden when loading the mode
     * You can access a config value using $this->getConfig('configkey');
     *
     * @see \Cake\Core\InstanceConfigTrait
     */
    protected $_defaultConfig = [];

    /**
     * Main method of the mode.
     *
     * If the mode is to take over the response of the current request, this
     * method should return a Response object. It can return null if the request
     * should follow the classic request cycle
     *
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response;
    }
}
