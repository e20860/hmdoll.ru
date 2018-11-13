<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace app\models;

/**
 * Главная модель для работы с данными
 *
 * @author eugenie
 */
class Main extends \vendor\core\base\Model{
    public $table = 'items';
    // При необходимости осуществлять запросы по полю, 
    // которое называется не id объфвить здесь переменную
    // public $pk = 'имя_поля_для_запроса';
    
    public function getAllDolls() 
    {
        return \R::getAll("SELECT `id`, `name`, `description`,`dimensions`,`status`,`type`,`material`,`price`, ( SELECT file FROM sw_images WHERE item = items.id AND num = 1) picture FROM `items` WHERE ready");
    }
   
    public function getMainMenu() 
    {
        return \R::findAll('mmenu');
    } 
}