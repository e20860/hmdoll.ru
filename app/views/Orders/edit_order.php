    <main role="main" class="container">
        <form action="/orders/save" method="post">
            <input type="hidden" name="id" value="<?= $odata['id']?>">
		<div class="container">
			<p class="h1 text-center">Заказ № <?= $odata['num']; ?></p>
			<hr>
			<div class="row align-middle">
				<div class="col-sm-2">
					<strong>Поступил:</strong> <?= $odata['ordate']; ?>
				</div>
				<div class="col-sm-2">
					<strong>Время:</strong> <?= $odata['ortime']; ?>
				</div>
				<div class="col-sm-4">
					<strong>Статус:</strong> <input type="text" class="form-control" name="status" value="<?= $odata['status']; ?>">
				</div>
				<div class="col-sm-4">
					<strong>Оплата:</strong> <input type="text" class="form-control" name ="paid" value="<?= $odata['paid']; ?>">
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-3 text-info">
     			    <img class="img-fluid" src="<?= '../img/' . $odata['img']; ?>" alt="Конь в пальто">
				</div>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-5">
							<p class="h5 text-info">Изделие:&nbsp;<?= $odata['itemtype'] . ', ' . $odata['itemname']; ?>; </p>
						</div>
						<div class="col-sm-3">
							<p>Количество:&nbsp; <strong><?= $odata['quantity']; ?></strong></p>
						</div>
						<div class="col-sm-4">
							<p>Сумма:&nbsp;<strong><?= $odata['amount']; ?></strong></p>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<strong>Заказчик:</strong>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="customer" value="<?= $odata['customer']; ?>">
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<strong>Подробности:</strong>
						</div>
						<div class="col-sm-8">
                                                    <textarea class="form-control" name="details" rows="3"><?= $odata['details']; ?></textarea>
						</div>
					</div>
				</div>
				<hr>
			</div>	
			<hr>
			<div class="row">
				<div class="col-sm-8">
				</div>
				<div class="col-sm-2">
				  <div class="text-right">
                                      <button class="btn btn-success btn-sm" type="submit" >Сохранить</button>
				  </div>
				</div>
				<div class="col-sm-2">
				  <div class="text-right">
					<a class="btn btn-danger btn-sm" href="/orders/list" role="button">Отмена</a>
				  </div>
				</div>
			</div>
		</div>
	</form>	
        <hr>
</main>
