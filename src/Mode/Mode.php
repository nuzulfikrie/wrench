<?php
/**
 * Copyright (c) Yves Piquel (http://www.havokinspiration.fr)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Yves Piquel (http://www.havokinspiration.fr)
 * @link          http://github.com/HavokInspiration/wrench
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Wrench\Mode;

use Cake\Core\InstanceConfigTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Base class that Maintenance mode should extend
 */
abstract class Mode
{

    use InstanceConfigTrait;

    /**
     * Default config for the mode.
     * Extending classes should use this property to define default config parameters
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Constructor.
     * Will set the config using the methods from the InstanceConfigTrait
     *
     * @param array $config Array of parameters for the Mode
     */
    public function __construct($config = [])
    {
        $this->setConfig($config);
    }

    /**
     * Main method that will be called if the MaintenanceModeFilter has to be used
     * This method should return the response that will be sent in order to warn the
     * user that the current request can not be processed because the app is undergoing
     * maintenance
     *
     * Maintenance modes should extend and implement this method to return the proper
     * response to the user.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Current request being intercepted
     * @param \Psr\Http\Message\ResponseInterface $response Current response being sent
     * @return \Psr\Http\Message\ResponseInterface|null The response that will be sent
     */
    abstract public function process(ServerRequestInterface $request, ResponseInterface $response);

    /**
     * Add the headers configured in the current mode to the response.
     *
     * @param \Psr\Http\Message\ResponseInterface $response Current response being sent
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addHeaders(ResponseInterface $response)
    {
        $headers = $this->_config['headers'];
        if (!empty($headers)) {
            foreach ($headers as $headerName => $headerValue) {
                $response = $response->withHeader($headerName, $headerValue);
            }
        }

        return $response;
    }
}
