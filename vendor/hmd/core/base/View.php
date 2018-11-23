<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace vendor\hmd\core\base;

/**
 * Description of View
 *
 * @author eugenie
 */
class View {
    /**
     * Текущий маршрут вида
     * @var array
     */
    public $route = [];
    
    /**
     * Текущий вид
     * @var string Description
     */
    public $view;

    /**
     * Текущий шаблон вида
     * @var string
     */
    public $layout;
    
    /**
     * Хранилище скриптов
     * @scripts array
     */
    public $scripts = [];
    /**
     * Хранилище стилей
     * @styles array 
     */
    public $styles = [];
    
    /**
     * Хранилище метаданных
     * @meta array 
     */
    public static $meta = ['title' => '', 'desc' => '', 'keywords'=> ''];
    /**
     *  Конструктор
     * @param type $route
     * @param type $layout
     * @param type $view
     */
    
    public function __construct($route, $layout='', $view='') {
        $this->route = $route;
        
        if($layout === FALSE){
            $this->layout = FALSE;
        }else{
            $this->layout = $layout ?: LAYOUT;
        }
            
        $this->view = $view;
        
    }
    public function render($vars) {
        // Массив переменных превращаем в отдельные переменные
        if(is_array($vars)) {
            extract($vars);
            //debug($vars);
        }
        // Определяем вид
        $file_view   = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if(is_file($file_view)) {
            require $file_view;
        } else {
            echo "<p>Не найден вид <b>{$file_view}</b></p>";
        }
        $content = ob_get_clean();
        // При необходимости, определяем шаблон
        if(FALSE != $this->layout){
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($file_layout)){
                $content = $this->cutScript($content);
                $content = $this->cutStyle($content);
                
                $scripts = [];
                if (!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                $styles = [];
                if (!empty($this->styles[0])) {
                    $styles = $this->styles[0];
                }
                require $file_layout;
            } else {
                echo "<p>Не найден шаблон <b>{$file_layout}</b></p>";
            }
        }
    }
    
    /**
     * Вырезает скрипты из контента, чтобы вставить их после объявления jquery
     * @param type $content
     */
    protected function cutScript($content) {
        $pattern =  "#\<script.*?\>.*?\<\/script\>#si";
        if (!empty(preg_match_all($pattern, $content, $this->scripts))) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }
    
    /**
     *  Вырезает ссылки на стили из контента для того, 
     *  чтобы переместить их в шаблон (как скрипты)
     *  @param string $content
     */
    protected function cutStyle($content)
    {
        $pattern = "#<link.+.css.*>#si";
        if (!empty(preg_match_all($pattern, $content, $this->styles))) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    /**
     * Возвращает ранее сохранённые метаданные
     */
    public static function getMeta() {
       $str = '<title>' . self::$meta['title'] . '</title>'
               . '<meta name="description" content="' . self::$meta['desc'] .'">'
               . '<meta name="keywords" content="' . self::$meta['keywords'] .'">'; 
       echo $str;
    }
    
    /**
     *  Сохраняет метаданные в хранилище (статическое свойство)
     * @param string $title
     * @param string $desc
     * @param string $keywords
     */
    public static function setMeta($title='', $desc='',$keywords='') {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }
    
}
