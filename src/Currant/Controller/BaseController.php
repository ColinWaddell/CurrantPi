<?php
/**
 * BaseController.php
 *
 * @author     Iago Oliveira da Silva
 * @license    https://opensource.org/licenses/MIT  The MIT License (MIT)
 */
namespace Currant\Controller;

use Slim\Slim;

/**
 * Class BaseController
 * @package Currant\Controller
 */
abstract class BaseController
{
    /**
     * @var Slim $app
     */
    protected $app;

    /**
     * @var array $data
     */
    protected $data;

    /**
     * @var \Twig_Environment $twig
     */
    protected $twig;


    /**
     * Constructs a base controller and sets up all
     * the classes we need.
     *
     * @param Slim $app
     */
    public function __construct(Slim $app)
    {
        // Gets the Slim Application
        $this->app = $app;

        // Merges all the request information to easily retrieve
        $this->data = array_merge(array(),$app->request->params());

        // Retrieves the template engine
        $this->twig = $this->app->container->get('twig');

    }

}