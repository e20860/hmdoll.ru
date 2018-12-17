<?php

/*
 * HMDoll project framework of internet-shop
 * No License (OPEN GNU)
 * Author E.Slavko <e20860@mail.ru>
 */

namespace app\models;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Description of Page
 *
 * @author admin
 */
class Page extends \vendor\hmd\core\base\Model{
    /**
     * Возвращает набор данных дляредактирования заголовков страниц
     * return 
     */
    public function getHeaders()
    {
        return \R::getAll('SELECT `id`,`header`, `description` FROM pages');
    }
    /**
     *  Сохраняет строку таблицы pages - один заголовок
     * @param int $id
     * @param string $header
     * @param string $descr
     */
    public function updateHeader($id, $header, $descr)
    {
        $sql = "UPDATE `pages` SET `header`=?,`description`=? WHERE `id`=?";
        \R::exec($sql, array($header,$descr,$id));
//        $logger = new Logger('informer');
//        $logger->pushHandler(new StreamHandler(WWW.'/applogs/info.log', Logger::INFO));
//        $infostr = " сохранено: id ={$id} ,заголовок: {$header} содержание: {$descr}";
//        $logger->info($infostr);
        
    }
    
    public function getHomePage()
    {
        $sql = 'SELECT * FROM `home` WHERE 1';
        return \R::getAssoc($sql);
    }
    
    public function getHomePageItem($id)
    {
        $ret['id'] = $id;
        $sql = 'SELECT * FROM `home` WHERE id= ?';
        $ret['item'] = \R::getAssoc($sql,[$id]);
        $sql = 'SELECT DISTINCT `type` FROM `home`';
        $ret['types'] = \R::getAssoc($sql);
        $sql = 'SELECT DISTINCT `ord` FROM `home`';
        $ret['orders'] = \R::getAssoc($sql);
        return $ret;
    }
    
    public function updateHomePageItem($data)
    {
        $item = \R::load('home', $data["id"]);
        $item->img = $data['img'];
        $item->type = $data['type'];
        $item->ord = $data['ord'];
        $item->header = $data['header'];
        $item->content = $data['content'];
        $item->link = $data['link'];
        \R::store($item);
    }
    
}
