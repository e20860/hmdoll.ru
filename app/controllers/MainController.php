<?php

namespace app\controllers;

use app\models\Main;
use vendor\hmd\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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
    /**
     *  Главная страница сайта
     */
    public function indexAction() {
        
        $model = new Main();
        $dataset = $model->getHome();
        $title = 'Главная';
        $stylefile = WWW . '/include/mainstyle.inc';
        \vendor\hmd\core\base\View::setMeta('Главная страница', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','dataset','menu','stylefile'));
    } 
    
    /**
     * Страница куколок
     */
    public function dollsAction()
    {
        $model = new Main();
        $items = $model->getItems('dolls');
        $page  = $model->getPageRequis('dolls');
        $title = 'Куколки';
        $this->view = 'items';
        \vendor\hmd\core\base\View::setMeta('Куклы страница', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','items','page','menu'));
    }

    /**
     * Страница выкроек
     */
    public function patternsAction()
    {
        $model = new Main();
        $items = $model->getItems('patterns');
        $page  = $model->getPageRequis('patterns');
        $title = 'Выкройки';
        $this->view = 'items';
        \vendor\hmd\core\base\View::setMeta('Куклы страница', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','items','page','menu'));
    }
    
        /**
     * Страница куколок
     */
    public function setsAction()
    {
        $model = new Main();
        $items = $model->getItems('sets');
        $page  = $model->getPageRequis('sets');
        $title = 'Наборы';
        $this->view = 'items';
        \vendor\hmd\core\base\View::setMeta('Куклы страница', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','items','page','menu'));
    }

     public function mclassAction()
    {
        $model = new Main();
        $items = $model->getItems('mclass');
        $page  = $model->getPageRequis('mclass');
        $title = 'Мастер-классы';
        $this->view = 'items';
        \vendor\hmd\core\base\View::setMeta('Куклы страница', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','items','page','menu'));
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
           $logger = new Logger('postman');
           $logger->pushHandler(new StreamHandler(WWW.'/applogs/mail.log', Logger::INFO));
           $infostr = " ## {$subject} , содержание: {$msg}";
           $logger->info($infostr);
        }
        exit();
    }
    
    /**
     * Показывает одну куклу
     */
    
    public function itemAction()
    {
        $model = new Main();
        //$this->layout = 'showitem';
        $this->view = 'item';
        $item_id = $_GET['id'];
        $title = 'Одна кукла';
        $one_item = $model->getOneDoll($item_id);
        $pics = $model->getPictures($item_id);
        $video = $model->getVideo($item_id);
        $modalfile = WWW . '/include/modalvideoitem.inc';
        $stylefile = WWW . '/include/showitemstyle.inc';
        \vendor\hmd\core\base\View::setMeta('Одна кукла', 'Страница представления одной куклы', 'Ключевые слова');
        $this->set(compact('title', 'one_item','menu', 'pics','video','modalfile','stylefile'));
   
    }
    /**
     * Обрабатывает заказ
     */
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
    /**
     * Страница "О нас"
     */
    public function aboutAction()
    {
        $model = new Main();
        $title = 'О нас';
        $this->set(compact('title'));
    }
    
    /**
     * Страница Оплата и доставка
     */
    public function howtopayAction()
    {
        $model = new Main();
        $title = 'Оплата и доставка';
        $this->set(compact('title'));
    }
    
}
