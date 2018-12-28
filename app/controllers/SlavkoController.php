<?php

/*
 * HMDoll project framework of internet-shop
 * No License (OPEN GNU)
 * Author E.Slavko <e20860@mail.ru>
 */

namespace app\controllers;

use app\models\Slavko;
//use vendor\hmd\core\App;

/**
 * Класс для административной части сайта
 *
 * @author Slavko
 */
class SlavkoController extends SlController{
    /**
     * Главная страница админки
     */
    public function indexAction() {
        checkLogin();
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
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        if(!empty($login)) {
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $correct = $model->checkLogin(compact('login','password'));
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
     * Выводит на редактирование страницы
     */
    public function editpagesAction()
    {
        $this->view = 'pagesedt';
        $model = new Slavko();
        $fname = filter_input(INPUT_GET, 'fname',FILTER_SANITIZE_SPECIAL_CHARS);
        $file = $model->getFileName($fname);
        if(!is_file($file)){ 
            throw new Exception( 'Файл ' .$fname . ' не найден');
        }
        $title = 'Редактирование страниц';
        $pcontent = file_get_contents($file);
        $this->set(compact('title','pcontent','fname'));
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
        $model = new Slavko();
        $fname = filter_input(INPUT_POST, 'fname',FILTER_SANITIZE_SPECIAL_CHARS);
        if(isset($fname)) {
            $filename = $model->getFileName($fname);
            $fcontent = filter_input(INPUT_POST, 'txtedt');
            if(is_file($filename)){
                 file_put_contents($filename, $fcontent);
             }
        }
        header("Location: /slavko/index");
    }
}
