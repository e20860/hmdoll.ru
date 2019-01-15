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
            
           //Проверка капчи
           $rsp = filter_input(INPUT_POST, "g-recaptcha-response", FILTER_SANITIZE_STRING); 
           if(!$rsp) {
               echo 'Докажите, что Вы не робот...';
               exit();
           } 
           $url = "https://www.google.com/recaptcha/api/siteverify";
           $key = "6LfdrIYUAAAAANHONwEYxx3IKUGhd_KdBp4_mqJD";
           $query = $url . '?secret='. $key . '&response=' . $rsp . '&remoteip=' .$_SERVER['REMOTE_ADDR'];
           $ans = json_decode(file_get_contents($query));
           if($ans->success == false) {
               echo 'Не пройдена проверка на робота';
               exit();
           }
           // проверку прошли
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
        $item_id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
        $title = 'Заказ';
        $one_item = $model->getOneDoll($item_id);
        $pics = $model->getPictures($item_id);
        \vendor\hmd\core\base\View::setMeta('Одна кукла', 'Страница представления одной куклы', 'Ключевые слова');
        $this->set(compact('title', 'one_item','menu', 'pics'));
    }
    
    /**
     * Сохраняет заказ и отправляет письма хозяину и заказчику
     */
    public function sendOrderAction()
    {
        $model = new Main();
        $this->layout = null;
        $item = filter_input(INPUT_POST,'item_id',FILTER_SANITIZE_NUMBER_INT);
        $quantity = filter_input(INPUT_POST,'quantity',FILTER_SANITIZE_NUMBER_INT);
        $amount = filter_input(INPUT_POST,'amount',FILTER_SANITIZE_NUMBER_INT);
        $fam = filter_input(INPUT_POST,'family',FILTER_SANITIZE_STRING);
        $nam = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
        $sur = filter_input(INPUT_POST,'surname',FILTER_SANITIZE_STRING);
        $cust = $fam . ' ' . $nam . ' ' . $sur;
        $cust_email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $email = 'email: ' . $cust_email;
        $phone = 'телефон: ' . filter_input(INPUT_POST,'phone',FILTER_SANITIZE_STRING);
        $adr = filter_input(INPUT_POST,'address',FILTER_SANITIZE_STRING);
        $address = $adr ? 'адрес: ' . $adr : '';
        $wish = 'Пожелания: ' . filter_input(INPUT_POST,'wishes',FILTER_SANITIZE_STRING);
        $details = $email . ', ' . $phone .', ' . $address . ', ' .$wish;
        $order = compact('item','quantity','amount','cust','details');
        $ordnum = $model->storeOrder($order); // Уникальный номер заказа
        // Отслать мыло
        $item_desc = $model->getOneDoll($item);
        $this->sendMailSeller($item_desc, $ordnum, $cust_email);
        $this->sendMailCustomer($item_desc, $ordnum, $cust_email,$cust);
        // Обратная информация для страницы заказа и переход на неё
        $_SESSION['order_info'] ='Заказ №'. $ordnum .' для ' . $cust . ' сформирован';
        //на ту же страницу, откуда пришли
        header("Location: /main/order?id=" .$item);
    }
    
    public function sendMailSeller($item,$order_num, $cust_email) 
    {
        $msg   = 'Внимание! в ' .date('h:i d.m.Y') .'г. получен заказ №' . 
                $order_num . ' на изделие ' 
                . $item['type'] .' от ' .$cust_email;
        $subject = 'Заказ № ' . $order_num;
        $reciever = 'hm.doll@yandex.ru';
        $headers = 'From: <'.$cust_email.'>' . "\r\n";
        $headers .= "Content-type: text/html; charset=\"utf-8\"";
        mail($reciever, $subject, $msg, $headers);
        
    }
    
    public function sendMailCustomer($item,$order_num, $cust_email, $customer) 
    {
        $msg   = 'Здравствуйте, уважаемый/ая ' .$customer 
                . ' в ' .date('h:i d.m.Y') .'г. от Вас нами получен заказ №' . 
                $order_num . ' на изделие ' 
                . $item['type'] .' стоимостью '. $item['price']
                .'. При получении оплаты товар будет Вам немедленно отправлен.'
                . ' С уважением, HMDoll';
        $subject = 'Заказ № ' . $order_num;
        $reciever = $cust_email;
        $headers = 'From: <hm.doll@yandex.ru>' . "\r\n";
        $headers .= "Content-type: text/html; charset=\"utf-8\"";
        mail($reciever, $subject, $msg, $headers);
        $logger = new Logger('postman');
        $logger->pushHandler(new StreamHandler(WWW.'/applogs/mail.log', Logger::INFO));
        $infostr = " ## {$subject} , содержание: {$msg}";
        $logger->info($infostr);
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
