<!-- Заказ оформление отправка -->
<main role="main" class="container">
    <div class="container">
        <p class="h1 text-center">Оформление заказа</p>
        <?php if(isset($_SESSION['order_info'])):  ?>
            <p class="h3 text-info text-right"><?php echo $_SESSION['order_info']; 
            unset($_SESSION['order_info'])?></p>
        <?php endif; ?>
        <hr>
        <div class="row">
            <div class="col-sm-3 text-info">
                <p class="h5 "><?php echo $one_item['name'] ?></p>
                <hr>
                <img class="img-fluid" src="<?php echo IMAGES .'/'.($pics[1]); ?>" alt="Изображение куклы">
                <hr>
                <ul>
                    <li><b>Тип изделия:</b>&nbsp;&nbsp;<?php echo $one_item['type']; ?></li>
                    <li><b>Материал:</b>&nbsp;&nbsp;<?php echo $one_item['material']; ?></li>
                    <li><b>Статус:</b>&nbsp;&nbsp;<?php echo $one_item['status']; ?></li>
                    <li><b>Размеры:</b>&nbsp;&nbsp;<?php echo $one_item['dimensions']; ?></li>
                </ul>
                <hr>
                <p class="h5 text-left"><b>Цена:<?php echo $one_item['price']; ?> руб</b></p>
            </div>
            <div class="col-sm-9">
                <div class="container">
                    <p class="h5">Заполните, пожалуйста, форму</p>
                    <hr>
                    <p class="text-light bg-dark">Данные получателя (Кому и куда отправлять заказ):</p>
                    <form action="/main/sendOrder" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $one_item['id']; ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="amount" value="<?php echo $one_item['price']; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputFam">Фамилия <small>обязательно</small></label>
                              <input type="text" class="form-control" id="inputFam" name="family" placeholder="Фамилия получателя" required="required">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputNam">Имя <small>обязательно</small></label>
                              <input type="text" class="form-control" id="inputNam" name="name" placeholder="Имя получателя" required="required">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputSurn">Отчество</label>
                              <input type="text" class="form-control" id="inputSurn" name="surname" placeholder="Отчество получателя">
                            </div>
                        </div>
                        <?php if($one_item['type'] == 'кукла'):?>
                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <label for="inputAddress">Адрес <small>обязательно</small></label>
                                <textarea class="form-control" id="inputAddress" name="address" rows="3" required="required"></textarea>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <label for="inputWishes">Ваши пожелания/требования</label>
                                <textarea class="form-control" id="inputWishes" name="wishes" rows="3" >
                                </textarea>
                            </div>
                        </div>                        <p class="text-light bg-dark">Контактные данные (с кем обмениваться информацией):</p> 
                        <div class="form-row text-primary">
                            <div class="form-group col-md-6">
                              <label for="inputEmail">email <small>обязательно</small></label>
                              <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Контактный адрес электронной почты" required="required">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputPhone">телефон</label>
                              <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="Контактный телефон">
                            </div>
                        </div>
                        <div class="text-right">
                              <button type="submit" class="btn btn-primary mr-3">Отправить</button>
                        </div>
                    </form>
                </div>        
            </div>
        </div>
        <hr>
    </div>
</main>