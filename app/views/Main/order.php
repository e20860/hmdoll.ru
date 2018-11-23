<!-- Заказ оформление отправка -->
    <main role="main" class="container">
		<div class="container">
			<p class="h1 text-center">Оформление заказа</p>
			<hr>
			<div class="row">
				<div class="col-sm-3 text-info">
					<p class="h5 "><?php echo $one_item['name'] ?></p>
					<hr>
     			    <img class="img-fluid" src="<?php echo IMAGES .'/'.($pics[1]); ?>" alt="Изображение куклы">
					<hr>
					<ul>
                                            <li><b>Тип куклы:</b>&nbsp;&nbsp;<?php echo $one_item['type'] ?></li>
                                            <li><b>Материал:</b>&nbsp;&nbsp;<?php echo $one_item['material'] ?></li>
                                            <li><b>Статус:</b>&nbsp;&nbsp;<?php echo $one_item['status'] ?></li>
                                            <li><b>Размеры:</b>&nbsp;&nbsp;<?php echo $one_item['dimensions'] ?></li>
					</ul>
					<hr>
					<p class="h5 text-left"><b>Цена:<?php echo $one_item['price'] ?> руб</b></p>
				</div>
				<div class="col-sm-9">
					<div class="container">
						<p class="h5">Заполните, пожалуйста форму</p>
						<hr>
						<p class="text-light bg-dark">Данные получателя (Кому и куда отправлять посылку):</p>
						<form>
						  <div class="form-row">
							<div class="form-group col-md-4">
							  <label for="inputFam">Фамилия</label>
							  <input type="text" class="form-control" id="inputFam" placeholder="Фамилия получателя">
							</div>
							<div class="form-group col-md-4">
							  <label for="inputNam">Имя</label>
							  <input type="text" class="form-control" id="inputNam" placeholder="Имя получателя">
							</div>
							<div class="form-group col-md-4">
							  <label for="inputSurn">Отчество</label>
                                                          <input type="text" class="form-control" id="inputSurn" placeholder="Отчество получателя">
							</div>
						  </div>
						  <div class="form-row">
							<div class="form-group col-md-2">
							  <label for="inputZip">Индекс</label>
							  <input type="text" class="form-control" id="inputZip">
							</div>
							<div class="form-group col-md-4">
							  <label for="inputState">Регион (область, край...)</label>
                                                          <input type="text" class="form-control" id="inputState" >
							</div>
						  <div class="form-group col-md-6">
							  <label for="inputCity">Город</label>
							  <input type="text" class="form-control" id="inputCity">
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputAddress">Адрес</label>
							<input type="text" class="form-control" id="inputAddress" placeholder="улица, дом, корпус, квартира...">
						  </div>
						 <p class="text-light bg-dark">Контактные данные (с кем обмениваться информацией):</p> 
						 <div class="form-row text-primary">
							<div class="form-group col-md-6">
							  <label for="inputEmail">email</label>
							  <input type="email" class="form-control" id="inputEmail" placeholder="Контактный адрес электронной почты">
							</div>
							<div class="form-group col-md-6">
							  <label for="inputPhone">телефон</label>
							  <input type="text" class="form-control" id="inputPhone" placeholder="Контактный телефон">
							</div>
						  </div>
					  </div>
					  <div class="text-right">
						<button type="submit" class="btn btn-primary mr-3">Отправить</button>
					  </div>
					</form>
				</div>
			</div>
			<hr>
		</div>
	</main>