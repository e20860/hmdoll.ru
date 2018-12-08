<?php
/* * 
 *  Главная точка входа в систему
 *      Фронт-контроллер
 * 
 */
use vendor\hmd\core\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);
define('DEBUG', 1);
define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/hmd/core');
define('ROOT', dirname(__DIR__));
define('LIBS', dirname(__DIR__) .'/vendor/hmd/libs');
define('APP', dirname(__DIR__) . '/app');
define('CACHE', dirname(__DIR__) . '/tmp/cache');
define('IMAGES', '/public/img');
define('LAYOUT','default');

$query = rtrim($_SERVER['QUERY_STRING'],'/');

require '../vendor/hmd/libs/functions.php';

// Классы грузятся и регистрируются автоматом
//spl_autoload_register(function($class){
//    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
//    if(is_file($file)) {
//        require_once $file;
//    }
//});

// Вместо собственного автозагрузчика - Composer
require_once '..\vendor\autoload.php';
// Запускаем проложение
new vendor\hmd\core\App;

// Пользовательские маршруты (если надо что-то сделать нестандартно)
// например, перенаправить pages на Posts
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller'=> 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

Router::add('^about$', ['controller'=> 'Main', 'action' => 'about']);
Router::add('^howtopay$', ['controller'=> 'Main', 'action' => 'howtopay']);

// Админка
Router::add('^slavko$', ['controller'=> 'Slavko', 'action' => 'login']);

//маршруты по умолчанию
// Если пустой URL - перенаправляется на главную страницу
Router::add('^$',['controller' => 'Main', 'action' => 'index']);

// Во всех остальных случаях - первый параметр - controller
// второй - action, дальше: GET-параметры самого action
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);

    