<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 *
 * @version 2.2
 * @date updated Sept 19, 2015
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;
use Helpers\Url;

/* Define routes. */
Router::any('', 'Controllers\LoginController@index');
Router::any(Url::URL_LOGIN, 'controllers\LoginController@login');
Router::any(Url::URL_LOGOUT, 'controllers\LoginController@logout');

Router::any(Url::URL_NEW_USER, 'controllers\NewUserController@index');
Router::any(Url::URL_INS_NEW, 'controllers\NewUserController@insertNewUSer');

Router::any(Url::URL_DASHBOARD, 'controllers\DashboardController@index');
Router::any(Url::URL_DASHBOARD_AJAX, 'controllers\DashboardController@ajax');

Router::any(Url::URL_RENCONTRE . "/(:any)", 'controllers\RencontreController@index');
Router::any(Url::URL_RENCONTRE_AJAX, 'controllers\RencontreController@ajax');


/* Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');

/* If no route found. */
Router::error('Core\Error@index');

/* Turn on old style routing. */
Router::$fallback = false;

/* Execute matched routes. */
Router::dispatch();
