<?php

/*
 * HMDoll project framework of internet-shop
 * No License (OPEN GNU)
 * Author E.Slavko <e20860@mail.ru>
 */

namespace app\controllers;

use app\models\Slavko;
use vendor\hmd\core\App;

/**
 * Description of Slavko
 *
 * @author Slavko
 */
class SlavkoController extends SlController{
    /**
     * Главная страница админки
     */
    public function indexAction() {
        $this->checkLogin();
        $model = new Slavko();
        $items = $model->getAllDolls();
        $title = 'Управление магазином';
        \vendor\hmd\core\base\View::setMeta('Главная страница', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','items'));
    } 
    /**
     *  Вход в админку
     */
    public function loginAction() {
        $model = new Slavko();
        if(isset($_POST['login'])) {
            $correct = $model->checkLogin($_POST);
            if($correct) {
                header('Location: /slavko/index');
                $_SESSION['tmp'] = "04091957";
            } else {
                header('Location: /main/index');
            }
        }
        $this->layout = 'empty';
        $this->view = 'login';
        $stylefile = 'include/loginstyle.inc';
        $title = 'Авторизация';
        $this->set(compact('title','stylefile'));
    }
    /**
     * Выводит список товаров. 
     * Тип товара (dolls/patterns/sets) - в $_GET['item'] 
     */
    public function itemsAction()
    {
        $this->checkLogin();
        $this->view = 'items';
        $model = new Slavko();
        if(isset($_GET['item'])) {
            $item_type = $_GET['item'];
        } else {
            $item_type = 'dolls';
        }
        $_SESSION['item_type'] = $item_type;
        $item_name = $model->getItemName($item_type);
        $items = $model->getItems($item_type);
        $title = 'Правка данных';
        \vendor\hmd\core\base\View::setMeta('Редактирование товаров', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','items','item_type','item_name'));
    }
    /**
     * Создаёт новый виртуальный объект изделия со всеми подчинёнными данными
     * и предъявляет его для дальнейшего редактироапния в форме edit_item
     * В базу данных ничего не записывается
     */
    public function addItemAction() 
    {
        $this->view = 'edit_item';
        $model = new Slavko();
        if(isset($_GET['item'])) {
            $item_type = $_GET['item'];
        } else {
            $item_type = 'dolls';
        }
        $dataset = $model->getEditDataSet();
        $title = 'Новый товар';
        \vendor\hmd\core\base\View::setMeta('Новый товар', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','dataset'));
        // фотки и видео - в сессию для кросспроцедурной обработки
        $_SESSION['images'] = $dataset['images'];
    }
    public function editItemAction() 
    {
        $this->view = 'edit_item';
        $model = new Slavko();
        if(isset($_GET['id'])) {
            $item_id = $_GET['id'];
        } else {
            $item_id = NULL;
        }
        $dataset = $model->getEditDataSet($item_id);
        $title = 'Редактируем образец';
        \vendor\hmd\core\base\View::setMeta('Редактирование товара', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','dataset'));
        // фотки и видео - в сессию для кросспроцедурной обработки
        $_SESSION['images'] = $dataset['images'];
    }
    
    public function delItemAction()
    {
        if(isset($_GET['id'])) {
            $item_id = $_GET['id'];
        } else {
            redirect();
        }
        $this->view = null;
        $model = new Slavko();
        $model->delItem($item_id);
        header("Location: /slavko/items?item={$_SESSION['item_type']}");
        
    }

        /**
     * Предъявляет словари для редактирования
     */
    public function vocsAction()
    {
        $this->checkLogin();
        $this->view = 'edit_vocs';
        $model = new Slavko();
        $title = 'Общие справочники';
        \vendor\hmd\core\base\View::setMeta('Редактирование справочников', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title'));
    }
    /**
     * Работа с пользовтелями
     */
    public function userAction()
    {
        $this->checkLogin();
        $model = new Slavko();
        if(isset($_POST['login'])){
            $model->addUser($_POST);
        }
        if(isset($_GET['id'])) {
        $model->delUser($_GET['id']);
        }
        $this->view = 'user';
        $users = $model->getUserList();
        $title = 'Пользователи';
        $this->set(compact('title','users'));
    }
    /**
     * Возвращает файл настроек или протокола для админки
     */
    public function getfileAction() 
    {
        $this->layout = null;
        $model = new Slavko();
        if(!isset($_GET['fname'])) { echo 'Файл не указан';  die(); }
        $fname = $model->getFileName($_GET['fname']);
        if(!is_file($fname)){ echo 'Файл ' .$fname . ' не найден'; die();}
        echo  file_get_contents($fname);
        exit();
    }
    /**
     * Сохраняет изменённые файлы протоколов и настроек админки
     */
    public function savelogsAction() 
    {
        $this->layout = null;
        if(isset($_POST)) {
            $filename = $this->getFileName($_POST['fname']);
            $file = $_POST['txtedt'];
             if(is_file($filename)){
                 file_put_contents($filename, $file);
             }
        }
        redirect();
    }
    /**
     * Загружает на сервер картинку изделия (куклы) по запросу ajax
     */
    public function uploadAction()
    {
        $this->layout = null;
        $path = WWW . '/img/';
        $fname = $_FILES['file']['name'];
        if (0 < $_FILES['file']['error']) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path . $_FILES['file']['name']);
            // Добавляем элемент в $_SESSION['images']
            if(isset($_SESSION['images'])) {
                $keys = array_keys($_SESSION['images']);
                $item = $_SESSION['item_id'];
                $num = count($keys) + 1;
                $file = $fname;
                $crdinfo = compact('item', 'file', 'num');
                $_SESSION['images'][] = $crdinfo;
                echo json_encode($crdinfo);
            }
        }
        exit();
    }
    /**
     * Удаляет элемент массива фотографий изделия по его номеру (AJAX)
     */
    public function delimgAction() 
    {
        $this->layout = null; 
        $num = $_GET['num'];
        $rs = json_encode(['Not Found']);
        if(isset($_SESSION['images'])) {
            $find = 0; 
            foreach ($_SESSION['images'] as $key => $value) {
                if($value['num'] == $num) {$find = $key;}
            }
            if($find) {
                unset($_SESSION['images'][$find]);
                $this->reordImgArray();
                $rs = json_encode($_SESSION['images']);
            }
        }
        echo $rs ;
        exit();
    }
    
    public function clearImagesAction()
    {
        $_SESSION['images'] = array();
    }

    /**
     *  Перенумеровывает фотографии в массиве
     */
    public function reordImgArray() 
    {
        $n = 1;
        foreach ($_SESSION['images'] as $key => &$value) {
            $value['num'] = $n;
            $n++;
        }
    }
    public function saveItemAction()
    {
        if(!isset($_POST['id'])) {
            throw new Exception('Отсутствуют данные для сохранения');
        }
        $this->layout = null;
        $model = new Slavko();
        $dataset = [];
        $dataset['item'] = $_POST;
        $dataset['images'] = $_SESSION['images'];
        $model->saveItem($dataset);
        header("Location: /slavko/items?item={$_SESSION['item_type']}");
    }

    /**
     * Проверяет, был ли корректный вход в систему
     * и, если нет - выход откуда пришли
     */
    private function checkLogin()
    {
        if(isset($_SESSION['tmp'])) {
            if($_SESSION['tmp'] != "04091957") {
                redirect();
            }
        } else {
            redirect();
        }
    }
}
