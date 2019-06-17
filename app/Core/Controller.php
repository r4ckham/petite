<?php
/**
 * Controller - base controller.
 *
 * @author David Carr - dave@daveismyname.com
 *
 * @version 2.2
 * @date June 27, 2014
 * @date updated Sept 19, 2015
 */
namespace Core;

use Helpers\hError;
use Helpers\hUrl;
use Helpers\hUser;
use Helpers\Url;

/**
 * Core controller, all other controllers extend this base controller.
 */
abstract class Controller
{
    /**
     * View variable to use the view class.
     *
     * @var string
     */
    public $view;

    /**
     * Language variable to use the languages class.
     *
     * @var string
     */
    public $language;

    /**
     * On run make an instance of the config class and view class.
     */
    public function __construct()
    {
        if(!hUser::isConnected() &&  Url::detectUri() != "/"  ){
            if(Url::detectUri() != Url::URL_LOGIN && Url::detectUri() != Url::URL_NEW_USER && Url::detectUri() != Url::URL_INS_NEW ){
                hUrl::redirectFromError("", hError::NOT_CONNECTED);
            }
        }
        /* initialise the views object */
        $this->view = new View();

        /* initialise the language object */
        $this->language = new Language();
    }
}
