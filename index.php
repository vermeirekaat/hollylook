<?php
session_start(); 

ini_set('display_errors', true);
error_reporting(E_ALL);

$routes = array(
  'home' => array(
    'controller' => 'Pages',
    'action' => 'index'
  ), 
  'history' => array(
    'controller' => 'Movies', 
    'action' => 'history'
  ), 
  'gallery' => array(
    'controller' => 'Pages', 
    'action' => 'gallery'
  ), 
  'detail' => array(
    'controller' => 'Pages', 
    'action' => 'detail'
  ), 
  'blog' => array(
    'controller' => 'Pages', 
    'action' => 'blog'
  ), 
  'article' => array(
    'controller' => 'Pages', 
    'action' => 'article'
  ), 
  'create' => array(
    'controller' => 'Pages', 
    'action' => 'create'
  ), 
  'fame' => array(
    'controller' => 'Pages', 
    'action' => 'fame'
  ),
);

if (empty($_GET['page'])) {
  $_GET['page'] = 'home';
}
if (empty($routes[$_GET['page']])) {
  header('Location: index.php');
  exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once __DIR__ . '/controller/' . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
