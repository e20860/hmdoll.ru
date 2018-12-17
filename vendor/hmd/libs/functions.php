<?php

/** 
 * Выводит переменную (массив) в отформатированном виде для отладки
 */
function debug($arr) {
    echo '<pre> '. print_r($arr, TRUE) . '</pre>';
}

/**
 *  Определяет ip клиентской машины по данным сервера
 * @return type
 */
function get_client_ip()
{
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = @$_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

    return $ip;
}

/**
 * Перенаправляет пользователя туда, откуда пришёл или на главную
 */
function redirect()
{
    $right_path = '/main/index';
    if(isset($_SERVER['HTTP_REFERER'])) {
        $jp = parse_url($_SERVER['HTTP_REFERER'])['path'];
        if(!empty($jp)){
            $right_path = $jp;
        }
    }
    header("Location: {$right_path}");
}

    /**
     * Проверяет, был ли корректный вход в систему
     * и, если нет - выход откуда пришли
     */
    function checkLogin()
    {
        if(isset($_SESSION['tmp'])) {
            if($_SESSION['tmp'] != "04091957") {
                redirect();
            }
        } else {
            redirect();
        }
    }