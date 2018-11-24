<?php

namespace vendor\hmd\widgets\menu;

/**
 * Выводит меню
 *
 * @author E.Slavko 
 */
class Menu {
    
    /**
     * Данные для формирования меню получаемые из базы данных
     * @var array 
     */
    protected $data;

    /**
     * Дерево меню: преобразованный массив из данных
     * @var array
     */
    protected $menutree =[];
    
    /**
     * Файл описания меню (всё, до начала циклической части)
     * @var string 
     */
    protected $menutopfile = 'tpl/menutop.inc';
    
    /**
     * Файл завершения меню (всё, что после циклической части)
     * @var string
     */
    protected $menubottomfile = 'tpl/menubottom.inc';
    
        /**
     * Файл шаблона одиночного пункта меню
     * @var string 
     */
    protected $menuitemfile = 'tpl/menuitem.inc';
    
    /**
     * Файл пункта меню с выпадающей частью
     * @var string 
     */
    protected $menudropfile = 'tpl/menudrop.inc';

    /**
     * Таблица формирования меню
     * @var string
     */
    protected $table = 'mmenu';
    
    /**
     * Сформированный HTML-код меню
     * @var string 
     */
    protected $menuHtml = '';
    /**
     * Конструктор
     * @param type $options
     */    
    public function __construct($options = []) 
    {
        $this->getOptions($options);
        $this->run();
    }

    /**
     *  Формирует свойства, если они передаются
     * произвольный массив с путями до файлов
     * $menuTopFile  
     * $menuBottomFile
     * $menuItemFile 
     * $menuDropFile 
     * $table
     *  @param type $options
     */
    protected function getOptions($options)
    {
        foreach ($options as $k => $v) {
            if(property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }
    /**
     *  Запускает меню
     */
    protected function run()
    {
        $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
        $this->menutree = $this->getTree($this->data);
        $this->menuHtml = $this->getMenu();
        $this->output();
    }
    
    /**
     * Преобразует массив данных в дерево меню
     * струтура массива:
     * строки следующего выда:
     * [$id]  => ['name'=>'$itemName', 'link'=>'$menuItemLink', 'parent'=>$parentId]
     * где $id - id пункта меню
     * $itemName - наименование пункта меню
     * $menuItemLink - ссылка данного пункта меню
     * $parentId - указатель на родительский пункт (0-для верхнего уровня)
     * 
     * @param array $data
     * @return array
     */
    protected function getTree($data)
    {
        $tree = [];
	foreach ($data as $id=>&$node) {    
            if (!$node['parent']){
		$tree[$id] = &$node;
            } else { 
		$data[$node['parent']]['childs'][$id] = &$node;
            }
	}
        return $tree;
	}
        
        /**
         *  Возвращает меню в формате HTML
         * @param type $tree
         * @return type
         */
        function getMenu() {
            
            ob_start();
            include($this->menutopfile);
            foreach ($this->menutree as $k => $v) {
                if (!isset($v['childs'])) {
                    include($this->menuitemfile);
                } else {
                    include($this->menudropfile);
                }
            }
            include($this->menubottomfile);
            return ob_get_clean();
    }
    protected function output()
    {
        echo $this->menuHtml;
    }
}
