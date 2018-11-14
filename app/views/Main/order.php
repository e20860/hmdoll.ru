<!-- Заказ оформление отправка -->
   <main role="main" class="container">
		<div class="container">
			<p class="h1 text-center">Заказ куклы</p>
			<hr>
			<div class="row">
				<div class="col-sm-4">
				   <img class="img-fluid" src="<?php echo IMAGES .'/'.($pics[1]); ?>" alt="Изображение куклы">
				</div>
				<div class="col-sm-4">
				</div>
				<div class="col-sm-4">
					<p class="h3"> Основные характеристики</p>
					<hr>
					<br>
					<ul>
                                            <li><b>Тип куклы:</b>&nbsp;&nbsp;<?php echo $one_item['type'] ?></li>
                                            <li><b>Материал:</b>&nbsp;&nbsp;<?php echo $one_item['material'] ?></li>
                                            <li><b>Статус:</b>&nbsp;&nbsp;<?php echo $one_item['status'] ?></li>
                                            <li><b>Размеры:</b>&nbsp;&nbsp;<?php echo $one_item['dimensions'] ?></li>
                                        </ul>
					<p class="h4 text-left"><b>&nbsp;&nbsp;&nbsp;&nbsp;Цена: <?php echo $one_item['price'] ?> руб</b></p>
					
				</div>
			</div>
			<hr>
		</div>
	    <div class="container">
		<p class="h3">Заполните форму заказа</p>
		<hr>
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
			  <input type="password" class="form-control" id="inputSurn" placeholder="Отчество получателя">
			</div>
		  </div>
		  <div class="form-row">
			<div class="form-group col-md-2">
			  <label for="inputZip">Индекс</label>
			  <input type="text" class="form-control" id="inputZip">
			</div>
			<div class="form-group col-md-4">
			  <label for="inputState">Область</label>
			  <select id="inputState" class="form-control">
				<option selected>Выбрать...</option>
				<option>...</option>
			  </select>
			</div>
		  <div class="form-group col-md-6">
			  <label for="inputCity">Город</label>
			  <input type="text" class="form-control" id="inputCity">
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputAddress">Адрес</label>
			<input type="text" class="form-control" id="inputAddress" placeholder="ул. Петькина, д.25, кв. 7">
		  </div>
		  
		  
		  </div>
		  <button type="submit" class="btn btn-primary">Заказать</button>
		</form>

	    </div>
    </main>