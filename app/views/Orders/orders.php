    <main role="main" class="container">
		<div class="row">
                    <div class="col-sm-12 text-center">
                        <p class="h1">Список заказов</p>
                    </div>
		</div>
		<hr>
		<div class="row text-center">
                    <div class="col-sm-1"><strong>#id</strong></div>
			<div class="col-sm-1"><strong>Номер</strong></div>
			<div class="col-sm-1"><strong>Дата</strong></div>
			<div class="col-sm-1"><strong>Тип</strong></div>
			<div class="col-sm-1"><strong>Имя</strong></div>
                        <div class="col-sm-1"><strong>К-во</strong></div>
                        <div class="col-sm-1"><strong>Сумма</strong></div>
                        <div class="col-sm-1"><strong>Статус</strong></div>
                        <div class="col-sm-1"><strong>Оплата</strong></div>
			<div class="col-sm-3"><strong>Действие</strong></div>
		</div>	
		<hr>
                <?php foreach($orders as $order):?>                
                    <div class="row align-middle">
                            <div class="col-sm-1 text-center"><?= $order['id'] ?></div>
                            <div class="col-sm-1 text-left"><?= $order['num'] ?></div>
                            <div class="col-sm-1"><?= $order['ordate'] ?></div>
                            <div class="col-sm-1 text-center"><?= $order['itemtype'] ?></div>
                            <div class="col-sm-1 text-center"><?= $order['itemname'] ?></div>
                            <div class="col-sm-1 text-center"><?= $order['quantity'] ?></div>
                            <div class="col-sm-1 text-right"><?= $order['amount'] ?></div>
                            <div class="col-sm-1"><?= $order['status'] ?></div>
                            <div class="col-sm-1 text-right"><?= $order['paid'] ?></div>
                            <div class="col-sm-1 text-center">
                                    <a class="btn btn-success btn-sm" href="/orders/edit?id=<?= $order['id'] ?>" role="button">Редакт</a>
                            </div>
                            <div class="col-sm-2 text-center">
                                    <a class="btn btn-danger btn-sm" href="#" role="button">Удалить</a>
                            </div>
                    </div>	
                    <hr>
                <?php endforeach;?>
		<hr>
		
    </main>

