<?php
/**
 * IndexController.php
 *
 * @author     Iago Oliveira da Silva
 * @license    https://opensource.org/licenses/MIT  The MIT License (MIT)
 */

namespace Currant\Controller;
use Currant\Native\NativeInvoker;


/**
 * Class IndexController
 * @package Currant\Controller
 */
class IndexController extends BaseController
{

    /**
     * The Main Page
     * @return string
     */
    public function indexAction()
    {
        $template = $this->twig->loadTemplate('public/index.twig');

        // Creates a new NativeInvoker
        $nativeInvoker = new NativeInvoker($this->app->scriptsPath);

        $this->data['hardwareInfo'] = $nativeInvoker->getHardwareInformation();
        $this->data['networkInfo'] = $nativeInvoker->getNetworkInformation();
        $this->data['loadInfo'] = $nativeInvoker->getLoadInformation();
        $this->data['memoryInfo'] = $nativeInvoker->getMemoryInformation();
        $this->data['storageInfo'] = $nativeInvoker->getStorageInformation();

        // Renders the template
        return $template->render($this->data);
    }

}