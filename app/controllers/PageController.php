<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace app\controllers;

use app\models\Page;
use vendor\hmd\core\App;


/**
 * Контроллер страниц админки
 *
 * @author Slavko
 */
class PageController extends SlController{
 
    public function pageheadersAction()
    {
        checkLogin();
        $this->view = 'headers';
        $model = new Page();
        $title = 'Заголовки страниц';
        $dataset = $model->getHeaders();
        \vendor\hmd\core\base\View::setMeta('Редактирование заголовков', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','dataset'));

    }
    
    public function saveStrAction() {
        $id = (int) filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $header = filter_input(INPUT_POST, 'header', FILTER_SANITIZE_STRING);
        $descr = filter_input(INPUT_POST, 'descr', FILTER_SANITIZE_STRING);
        $model = new Page();
        $model->updateHeader($id, $header, $descr);
        echo '1';
        header("Location: /page/pageheaders");
    }
    
    public function homeAction()
    {
        checkLogin();
        $this->view = 'hp_list';
        $model = new Page();
        $title = 'Домашняя страница';
        $dataset = $model->getHomePage();
        \vendor\hmd\core\base\View::setMeta('Редактирование заголовков', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','dataset'));
    }
    
    public function edithpitemAction() 
    {
        checkLogin();
        $this->view = 'hp_edt';
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!$id) {
            throw new \Exception('Неверные данные');
        }
        $model = new Page();
        $title = 'Домашняя страница';
        $dataset = $model->getHomePageItem($id);
        \vendor\hmd\core\base\View::setMeta('Редактирование заголовков', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','dataset'));
    }
    
    public function updatehpitemAction() 
    {   
        $id      = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
        $file    = filter_input(INPUT_POST,'file',FILTER_SANITIZE_STRING);
        $img     = filter_input(INPUT_POST,'img',FILTER_SANITIZE_STRING);
        $type    = filter_input(INPUT_POST,'type',FILTER_SANITIZE_STRING);
        $ord     = filter_input(INPUT_POST,'ord',FILTER_SANITIZE_NUMBER_INT);
        $link    = filter_input(INPUT_POST,'link',FILTER_SANITIZE_URL);
        $header  = filter_input(INPUT_POST,'header',FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST,'content',FILTER_SANITIZE_STRING);
        if(!empty($file) && $file != $img) {
            $img = $file;
        }
        $data = compact('id','img','type','ord','link','header','content');
        $model = new Page();
        $model->updateHomePageItem($data);
        header('Location: /page/home');
    }
    
        public function uploadimgAction()
    {
        $this->layout = null;
        $path = WWW . '/img/';
        $fname = $_FILES['file']['name'];
        if (0 < $_FILES['file']['error']) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path . $fname);
            echo $fname;
        }
        exit();
    }

}