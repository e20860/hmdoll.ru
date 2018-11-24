<?php

namespace app\controllers;

use app\models\Main;
use vendor\hmd\core\App;

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
        
        $model = new Main();
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
        //$menu = $model->getMainMenu();
        //
        $title = 'Главная';
        \vendor\hmd\core\base\View::setMeta('Главная страница', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','items','menu'));
    } 
    /**
     *  Отправляет запрос на почту владельца сайта
     *  со страницы экземпляра куклы.
     *  Информацию получает из суперглобального массива $_POST
     *  в результате Ajax-запроса
     */
    public function questionAction() {
        $this->layout = null;
        if ($this->isAjax()) {
           $name  = htmlspecialchars(stripslashes($_POST['uName']));
           $from = htmlspecialchars(stripslashes($_POST['uEmail']));
           $msg   = htmlspecialchars(stripslashes($_POST['uQuestion']));
           $subject = 'Вопрос: ' . $name . '(' .$from . ')';
           $reciever = 'hm.doll@yandex.ru';
           $headers = 'From: <'.$from.'>' . "\r\n";
           $headers .= "Content-type: text/html; charset=\"utf-8\"";
           
           $res = mail($reciever, $subject, $msg, $headers);
           echo 'Сообщение от ' .$name . ', его адрес: ' . $from . ', Код: ' . $res;
        }
        exit();
    }
    
    /**
     * Показывает одну куклу
     */
    
    public function itemAction()
    {
        $model = new Main();
        $this->layout = 'showitem';
        $this->view = 'item';
        $item_id = $_GET['id'];
        $title = 'Одна кукла';
        $one_item = $model->getOneDoll($item_id);
        $pics = $model->getPictures($item_id);
        \vendor\hmd\core\base\View::setMeta('Одна кукла', 'Страница представления одной куклы', 'Ключевые слова');
        $this->set(compact('title', 'one_item','menu', 'pics'));
   
    }
    
    public function orderAction() 
    {
        $model = new Main();
        $this->layout = 'default';
        $this->view = 'order';
        $item_id = $_GET['id'];
        $title = 'Заказ';
        $one_item = $model->getOneDoll($item_id);
        $pics = $model->getPictures($item_id);
        \vendor\hmd\core\base\View::setMeta('Одна кукла', 'Страница представления одной куклы', 'Ключевые слова');
        $this->set(compact('title', 'one_item','menu', 'pics'));
        
    }
    
    public function aboutAction()
    {
        $model = new Main();
        
    }
    
    public function howtopayAction()
    {
        $model = new Main();
        
    }
    
}
