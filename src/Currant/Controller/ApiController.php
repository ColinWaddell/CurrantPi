<?php
/**
 * ApiController.php
 *
 * @author     Iago Oliveira da Silva
 * @license    https://opensource.org/licenses/MIT  The MIT License (MIT)
 */

namespace Currant\Controller;


use Currant\Native\NativeInvoker;

class ApiController extends JsonController
{

    public function getAllInformation()
    {
        try {
            // Creates a new NativeInvoker
            $nativeInvoker = new NativeInvoker($this->app->scriptsPath);

            $this->data['hardwareInfo'] = $nativeInvoker->getHardwareInformation();
            $this->data['networkInfo'] = $nativeInvoker->getNetworkInformation();
            $this->data['loadInfo'] = $nativeInvoker->getLoadInformation();
            $this->data['memoryInfo'] = $nativeInvoker->getMemoryInformation();
            $this->data['storageInfo'] = $nativeInvoker->getStorageInformation();

            return $this->render($this->data);
        }
        catch(\Exception $ex)
        {
            return $this->renderError();
        }
    }

}