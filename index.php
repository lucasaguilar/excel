<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'composer/vendor/autoload.php';

ob_start();
error_reporting(E_ALL);
@ini_set('display_errors', on);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing;

try {

    $request = Request::createFromGlobals();

    /**
     *  create routes
     */
    $routes = new Routing\RouteCollection();
    $routes->add('\ExcelManipulationTools\Controller\IndexController', new Routing\Route('/'));
    //$routes->add('ExcelManipulationTools/Controller/Controller', new Routing\Route('/hello/{name}', array('name' => 'World')));
    $routes->add('bye', new Routing\Route('/bye'));

    $context = new Routing\RequestContext();
    $context->fromRequest($request);
    $matcher = new Routing\Matcher\UrlMatcher($routes, $context);

    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
    ob_start();

    $IndexController = new $_route;

    $result = $IndexController->main(dirname(__FILE__).'/Resources/Files/Libro2.xls');

    /*
    echo "<pre>";
    print_r($result);
    echo "</pre>";
    die;
    */

    $response = new Response(ob_get_clean());
    $response->setContent($result);


} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);

} catch (Exception $e) {

    $response = new Response('An error occurred: '.$e->getMessage(), 500);
}

$response->send();