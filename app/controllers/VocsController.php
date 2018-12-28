<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace app\controllers;

use app\models\Slavko;

/**
 * Description of VocsController
 *
 * @author eugenie
 */
class VocsController extends SlController{
         /**
     * Предъявляет словари для редактирования
     */
    public function vocsAction()
    {
        checkLogin();
        $this->view = 'edit_vocs';
        $model = new Slavko();
        $vocList = $model-> getVocList();
        $key = array_keys($vocList)[0];
        $currentVoc = $vocList[$key]['alias']; //Первый по списку
        $vocContent = $model->getVocContent($currentVoc);
        $title = 'Общие справочники';
        \vendor\hmd\core\base\View::setMeta('Редактирование справочников', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','vocList','currentVoc','vocContent'));
    }
    
    public function changeVocAction()
    {
        $vocName = filter_input(INPUT_POST, 'vocname', FILTER_SANITIZE_STRING);
        $model = new Slavko();
        $vocContent = $model->getVocContent($vocName, true);
        echo json_encode($vocContent);
        exit();
    }

    public function saveVocItemAction()
    {
        $vocName = filter_input(INPUT_POST, 'vocname', FILTER_SANITIZE_STRING);
        $vocId = filter_input(INPUT_POST, 'itemid', FILTER_SANITIZE_STRING);
        $vocData = filter_input(INPUT_POST, 'itemdata', FILTER_SANITIZE_STRING);
        $model = new Slavko();
        $model->saveVocItem($vocName, $vocId, $vocData);
        $vocContent = $model->getVocContent($vocName, true);
        echo json_encode($vocContent);
        exit();
    }
    
    public function delVocItemAction() {
        $vocName = filter_input(INPUT_POST, 'vocname', FILTER_SANITIZE_STRING);
        $vocId = filter_input(INPUT_POST, 'itemid', FILTER_SANITIZE_STRING);
        $model = new Slavko();
        $model->delVocItem($vocName, $vocId);
        $vocContent = $model->getVocContent($vocName, true);
        echo json_encode($vocContent);
        exit();
    }

    /**
     * Работа с пользовтелями
     */
    public function userAction()
    {
        checkLogin();
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
}
