<?php

/*
 * HMDoll project framework of internet-shop
 * No License (OPEN GNU)
 * Author E.Slavko <e20860@mail.ru>
 */

namespace app\controllers;

use app\models\Slavko;
/**
 * Description of OrdersController
 *
 * @author admin
 */
class OrdersController extends SlController {
    /**
     * Выводит список заказов
     */
    public function listAction()
    {
        checkLogin();
        $this->view = 'orders';
        $model = new Slavko();
        $orders = $model->getOrderList();
        $title = 'Работа с заказами';
        \vendor\hmd\core\base\View::setMeta('Редактирование заказов', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','orders'));
        
    }
    
    /**
     * Выводит один заказ на редактирование
     */
    public function editAction()
    {
        $this->view = 'edit_order';
        $model = new Slavko();
        $title = 'Редактирование заказа';
        $order_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if(is_null($order_id)) {
            $order_id = 1;
        }
        $odata = $model->getOrderData($order_id);
        
        \vendor\hmd\core\base\View::setMeta('Редактирование заказа', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','odata'));
    }
    
    /**
     * Сохраняет отредактированный заказ
     */
    public function saveAction() 
    {
        $sdata = [];
        $sdata['id'] = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
        $sdata['status'] = filter_input(INPUT_POST,'status',FILTER_SANITIZE_STRING);
        $sdata['paid'] = filter_input(INPUT_POST,'paid',FILTER_SANITIZE_NUMBER_INT);
        $sdata['customer'] = filter_input(INPUT_POST,'customer',FILTER_SANITIZE_STRING);
        $sdata['details'] = filter_input(INPUT_POST,'details',FILTER_SANITIZE_STRING);
        
        $model = new Slavko();
        $model->saveOrderData($sdata);
        header("Location: /orders/list");
    }
    
}
