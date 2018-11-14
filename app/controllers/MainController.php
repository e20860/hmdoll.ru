<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\App;

/*
 * Интернет - магазин HMDoll
 * Авторские права HMDoll E/Slavko
 * Открытый фреймворк.
 */

/**
 * Главный контроллер
 *
 * @author eugenie
 */
class MainController extends AppController {
    //Можно добавить шаблон и вид для контроллера
    public function indexAction() {
        
        $model = new Main;
        /*
        $items = App::$app->cache->get('items');
        if (!$items) {
            $items = \R::findAll('items');
            App::$app->cache->set('items', $items);
        }
        */
        //$items = \R::findAll('items');
        $items = $model->getAllDolls();
        //$menu  = \R::findAll('mmenu');
        $menu = $model->getMainMenu();
        //
        $title = 'Главная';
        \vendor\core\base\View::setMeta('Главная страница', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','items','menu'));
    } 
    public function testAction() {
        if ($this->isAjax()) {
           $model = new Main();
           $post = \R::findOne('articles', "id = {$_POST['id']}");
           //debug($post);
           $this->loadView('ajax', compact('post'));
           exit();
        }
        $model = new Main;
        $this->layout = 'main';
        $this->view = 'test';

    }
    
    /**
     * Показывает одну куклу
     */
    
    public function itemAction()
    {
        $model = new Main;
        $this->layout = 'showitem';
        $this->view = 'item';
        $item_id = $_GET['id'];
        $title = 'Одна кукла';
        $one_item = $model->getOneDoll($item_id);
        $pics = $model->getPictures($item_id);
        $menu = $model->getMainMenu();
        \vendor\core\base\View::setMeta('Одна кукла', 'Страница представления одной куклы', 'Ключевые слова');
        $this->set(compact('title', 'one_item','menu', 'pics'));
   
    }
    
    public function orderAction() 
    {
        $model = new Main;
        //$this->layout = 'default';
        $this->view = 'order';
        $item_id = $_GET['id'];
        $title = 'Заказ';
        $one_item = $model->getOneDoll($item_id);
        $pics = $model->getPictures($item_id);
        $menu = $model->getMainMenu();
        \vendor\core\base\View::setMeta('Одна кукла', 'Страница представления одной куклы', 'Ключевые слова');
        $this->set(compact('title', 'one_item','menu', 'pics'));
        
    }
}
