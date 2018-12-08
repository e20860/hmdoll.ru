<?php

/*
 * HMDoll.ru
 * 
 * Открытый фреймворк.
 */

namespace app\models;

/**
 * Главная модель для работы с данными
 *
 * @author eugenie
 */
class Main extends \vendor\hmd\core\base\Model{
    public $table = 'items';
    // При необходимости осуществлять запросы по полю, 
    // которое называется не id объфвить здесь переменную
    // public $pk = 'имя_поля_для_запроса';
    
    /**
     * Осуществляет запрос к таблице товаров (кукол)
     *  и возвращает массив объектов типа bean
     * @return array of bean
     */
    public function getAllDolls() 
    {
        return \R::getAll("SELECT `id`, `name`, `description`,`dimensions`,`status`,`type`,`material`,`price`, ( SELECT file FROM sw_images WHERE item = items.id AND num = 1) picture FROM `items` WHERE ready");
    }
    
    /**
     * Выбирает данные из таблицы items в зависимости от типа товара
     * куклы/выкройки/наборы
     * @param strinf $type тип товара (допустимые: dolls/patterns/sets)
     * @return array of bean
     */
    public function getItems($item_type)
    {
        $type = \R::getAssoc("SELECT * FROM types WHERE menu = ? LIMIT 1", [$item_type]);
        $type_id = array_keys($type)[0];
        $sql = "SELECT `id`, `name`, `description`,`status`,(SELECT `name` FROM articules WHERE articules.id = items.articul) artname, `price`, ( SELECT file FROM sw_images WHERE item = items.id AND num = 1) picture FROM `items` WHERE ready AND type = ?";
        return \R::getAll($sql,[$type_id]);
    }
    /**
     * Возвращает реквизиты страницы (заголовок и описание) по её наименованию
     * @param string $page Наименование страницы
     * @return array of bean
     */
    public function getPageRequis($page = 'dolls')
    {
        return \R::getAll("SELECT `header`,`description` FROM `pages` WHERE name = ? ", [$page])[0];
    }


    /**
     *  
     * @return bean
     */
    
    /**
     * Осуществляет запрос к таблице товаров (кукол)
     * и возвращает  объект типа bean
     * @param integer $id
     */
    public function getOneDoll($id)
    {
        $qq = "SELECT `id`,`name`,`description`,`dimensions`,`price`, "
                . "(SELECT name FROM statuses WHERE statuses.id = items.status) AS status, "
                . "(SELECT name FROM types WHERE types.id = items.type) AS type, "
                . "(SELECT name FROM materials WHERE materials.id = items.material) AS material "
                . "FROM `items` WHERE id = ?";
        
        $rq =  \R::getAll($qq, array($id));
        if($rq) {
            return $rq[0]; // Ассоциативный массив
        } else {
            return array();
        }
    }
    
    /**
     * Возвращает массив с картинками для одной куклы
     * @param int $id
     * @return array 
     */
 
    public function getPictures($id)
    {
        $ret = [];
        $ret[1] = 'hmd.gif';  // Если картинок нет - возвращаем логотип
        $tmp = \R::findAll('sw_images', 'item=?', array($id));
        foreach ($tmp as $bean) {
            $ret[$bean['num']] = $bean['file'];
        }
        return $ret;
    }
    
    public function getVideo($id)
    {
        $ret = [];
        
        $tmp = \R::findAll('sw_video', 'item=?', array($id));
        foreach ($tmp as $bean) {
            $ret[$bean['item']] = $bean['file'];
        }
        if (empty($ret)) {
            $ret[$id] = 'video1.mp4';  // Если видео нет - возвращаем Москву
        }
        return $ret[$id];
    }
    /**
     *  Возвращает главное меню
     * @return type
     */
    public function getMainMenu() 
    {
        return \R::findAll('mmenu');
    } 
}