<?php

/*
 * HMDoll project framework of internet-shop
 * No License (OPEN GNU)
 * Author E.Slavko <e20860@mail.ru>
 */

namespace app\models;

/**
 * Description of Slavko
 *
 * @author admin
 */
class Slavko extends \vendor\hmd\core\base\Model{
    
    public function getAllDolls() {
        return \R::getAll("SELECT `id`, `name`, `description`,`dimensions`,`status`,`type`,`material`,`price`, ( SELECT file FROM sw_images WHERE item = items.id AND num = 1) picture FROM `items` WHERE ready");
    }
    /**
     *  ВОзвращает список товаров по их типу
     * @param string $item_type тип товаров
     */
    public function getItems($item_type = 'dolls') {
        $type = \R::getAssoc("SELECT * FROM types WHERE menu = ? LIMIT 1", [$item_type]);
        $type_id = array_keys($type)[0];
        $sql = "SELECT `id`,`name`,`description`,`type`,`status`,`price`,`ready`,( SELECT file FROM sw_images WHERE item = items.id AND num = 1) picture,(SELECT name FROM articules WHERE articules.id = items.articul) AS articul FROM `items` WHERE type = ?";
        return \R::getAll($sql, [$type_id]);
    }
    /**
     * Возвращает массив массивов для страницы редактирования товара
     * 
     * @param int $id
     * @return array
     */
    public function getEditDataSet($id=null) {
        
        $ret = [];
        if (is_null($id)){
            // id= null - новая запись
            $item[0] = $this->getEmptyItem();
            // значения по умолчанию
            $images[] = ['item' => 0, 'file' => 'hmd.gif','num' => 1,];
            $video = [ 'item' =>0, 'file' => 'video1.mp4', ];
        } else {
            // из базы данных
            $item = \R::getAssoc('SELECT * FROM items WHERE id = ?', [$id]);
            $images = \R::getAssoc('SELECT * FROM sw_images WHERE item = ?', [$id]);
            $video = \R::getAssoc('SELECT * FROM sw_video WHERE item = ?', [$id]);
        }
        // Справочники для select'ов формы
        $ret['articules'] = \R::getAssoc('SELECT * FROM articules');
        $ret['types'] = \R::getAssoc('SELECT * FROM types');
        $ret['statuses'] = \R::getAssoc('SELECT * FROM statuses');
        $ret['materials'] = \R::getAssoc('SELECT * FROM materials');
        $ret['item'] = $item;
        $ret['images'] = $images;
        $ret['video'] = $video;
        return $ret;
    }
    /**
     * Возвращает пустой массив - строка таблицы items
     * @return array
     */
    private function getEmptyItem() 
    {
        
        return Array(
                    'name' => 'Новое изделие',
                    'description' => 'Описание',
                    'dimensions' => '0 на 0 см',
                    'status' => 1,
                    'type' => 1,
                    'material' => 1,
                    'price' => 0,
                    'ready' => 0,
                    'articul' => 1,
                );
    }
    
    public function getItemName($item)
    {
        $name = \R::getAssoc('SELECT name FROM types WHERE menu = ?', [$item]);
        return array_keys($name)[0];
    }

        /**
     * Создаёт нового пользователя и сохраняет его в базе данных
     * @param array $user Пользователь (содержимое $_POST)
     * @throws Exception
     */
    public function addUser($user)
    {
        if(!isset($user['login'])) {
            throw new Exception('Нет данных пользователя');
        }
        $u = \R::dispense('users');
        $u['login'] = $user['login'];
        $u['email'] = $user['email'];
        $u['name'] = $user['name'];
        $u['pass'] = password_hash($user['password'], PASSWORD_BCRYPT);
        \R::store($u);
    }
    /**
     *  Удаляет пользователя по его id
     * @param int $id
     */
    public function delUser($id)
    {
        $user = \R::load('users', $id);
        \R::trash($user);
    }

    /**
     * Возвращает список пользователей
     * @return bean
     */
    public function getUserList()
    {
        return \R::getAll("SELECT id, name, email, login FROM users");
    }
    
    /**
     * Проверяет корректность данных формы входа
     * @param array $data содержимое массива #_POST
     */
    public function checkLogin($data)
    {
        $user = \R::find('users', 'login = ?', [$data['login']]);
        $ret = false;
        if($user) {
            $ind = array_keys($user)[0];
            $pass = $user[$ind]['pass'];
            $ret = password_verify($data['password'],$pass);
        }
        return $ret;
    }
    /**
     * ВОзвращает имя файла протокола или настроек по его псевдониму
     * @param string $key псевдоним
     * @return string Имя файла
     */
    public function getFileName($key) {
        switch ($key) {
            case 'appset':
                $fname =  ROOT . '/config/config.php';
                break;
            case 'dbset':
                $fname =  ROOT . '/config/config_db.php';
                break;
            case 'accsvrlog':
                $fname =  ROOT . '/logs/access.log';
                break;
            case 'errsvrlog':
                $fname =  ROOT . '/logs/error.log';
                break;
            case 'errapplog':
                $fname =  WWW . '/applogs/errors.log';
                break;
            case 'maillog':
                $fname =  WWW . '/applogs/mail.log';
                break;
            case 'howtopay':
                $fname =  ROOT . '/app/views/Main/howtopay.php';
                break;
            case 'about':
                $fname =  ROOT . '/app/views/Main/about.php';
                break;
        }
        if(!isset($fname)) {
            throw new \Exception('Не удалось найти файл: ' .$key);
        }
        return $fname;
    }
    /**
     *  Сохраняет отредактированное изделие
     * @param array $dataset
     */
    public function saveItem($dataset)
    {
        $item = $dataset['item'];
        $images  = $dataset['images'];
        if($item['id']==0) { // Новое изделие
            $curitem = \R::dispense('items');
            $curvideo = \R::dispense('sw_video');
        } else { // Изделие есть...
            $curitem = \R::load('items', $item['id']);
            $sql = "SELECT * FROM `sw_video` WHERE item = ?";
            $curvideo = \R::find('sw_video', $sql, [$item['id']]);
        }
        $curitem->articul = $item['articul'];
        $curitem->type = $item['type'];
        $curitem->name = $item['name'];
        $curitem->description = $item['description'];
        $curitem->status = $item['status'];
        $curitem->dimensions = $item['dimensions'];
        $curitem->material = $item['materials'];
        $curitem->price = $item['price'];
        $curitem->ready = isset($item['ready'])?1:0;
        $_SESSION['item_id'] = \R::store($curitem);
        $curvideo->item = $_SESSION['item_id'];
        $curvideo->file = $item['video'];
        \R::store($curvideo);
        $this->saveImages($images);
        
        
    }
    
    public function saveImages($data)
    {
        $item_id = $_SESSION['item_id'];
        \R::exec('DELETE FROM `sw_images` WHERE `item` = ?', array($item_id));
        foreach ($data as $key => $value) {
            $sql = "INSERT INTO `sw_images`(`item`, `num`, `file`) VALUES (?,?,?)";
            \R::exec($sql,array($item_id,$value['num'],$value['file']));
        }
    }
    
    public function delItem($id)
    {
        $item_id = (int) $id;
        \R::exec('DELETE FROM `items` WHERE `id` = ?',array($item_id));
        \R::exec('DELETE FROM `sw_images` WHERE `item` = ?', array($item_id));
        \R::exec('DELETE FROM `sw_video` WHERE `item` = ?', array($item_id));
    }
    
    /**
     * Возвращает список справочников
     * @return array
     */
    public function getVocList()
    {
        $sql = 'SELECT * FROM `vocs`';
        return \R::getAssoc($sql);
    }
    /**
     * Возвращает содержимое справочника $name, при необходимости (transform=true)
     * конвертирует его в ассоциативный массив
     * @param string  $name наименование справочника
     * @param boolean $transform флаг необходимости конвертации
     * @return bean/array содержимое справочника
     */
    public function getVocContent($name, $transform = false)
    {
        $rv = \R::findAll($name);
        if($transform) {
            $rv = \R::exportAll($rv);
        }
        return $rv;
    }
    /**
     *  Сохраняет строку справочника $name с id = $itemId и данными $itemData
     * @param type $name
     * @param type $itemId
     * @param type $itemData
     */
    public function saveVocItem($name, $itemId, $itemData)
    {
        if(empty($itemId)) {
            $item = \R::dispense($name);
        } else {
            $item = \R::load($name, $itemId);
        }
        $item->name = $itemData;
        \R::store($item);
    }
    
    public function delVocItem($name, $itemId)
    {
        $item = \R::load($name, $itemId);
        \R::trash($item);
    }
    
    /**
     * Возвращает список заказов
     */
    public function getOrderList()
    {
         $sql = "SELECT `id`,`num`,DATE(time) AS ordate,
            (SELECT name from items WHERE items.id = orders.item) AS itemname, 
            (SELECT name from types WHERE types.id =(SELECT type from items WHERE items.id = orders.item)) AS itemtype,
            quantity,amount,status,paid 
            FROM `orders`";
        return \R::getAll($sql);
       
    }
    
    /**
     *  Возвращает набор данных одного заказа
     * @param int $oid id заказа
     */
    public function getOrderData($oid)
    {
         $sql = "SELECT `id`,`num`,DATE(time) AS ordate, TIME(time) AS ortime,
            (SELECT name from items WHERE items.id = orders.item) AS itemname, 
            (SELECT file from sw_images WHERE sw_images.item = orders.item AND num = 1) AS img, 
            (SELECT name from types WHERE types.id =(SELECT type from items WHERE items.id = orders.item)) AS itemtype,
            quantity,amount,status,paid,customer,details 
            FROM `orders` WHERE id = ?";
        return \R::getAll($sql,[$oid])[0];
    }
    
    public function saveOrderData($dt)
    {
        $order = \R::load('orders', $dt['id']);
        $order->status = $dt['status'];
        $order->paid = $dt['paid'];
        $order->customer = $dt['customer'];
        $order->details = $dt['details'];
        \R::store($order);
    }
} // class
