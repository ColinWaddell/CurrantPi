<?php
/**
 * JsonController.php
 *
 * @author     Iago Oliveira da Silva
 * @license    https://opensource.org/licenses/MIT  The MIT License (MIT)
 */

namespace Currant\Controller;


abstract class JsonController extends BaseController
{
    /**
     * Renders the JSON of a $params array
     * @param array $params
     */
    protected function render($params)
    {
        if(!is_array($params) || $params == NULL)
        {
            return $this->renderError();
        }

        echo json_encode($params,JSON_OBJECT_AS_ARRAY);
    }

    /**
     * Renders the default error JSON.
     *
     * @param $title The title of the error
     * @param $msg
     */
    protected function renderError(array $error=NULL)
    {
        $title = (isset($error['title']) ? $error['title'] : 'Error');
        $msg = (isset($error['message']) ? $error['message'] : 'Something went wrong.');

        echo json_encode(
            array(
                'error' => array(
                    'title' => $title,
                    'message' => $msg,
                )
            )
            ,JSON_OBJECT_AS_ARRAY);
    }
}