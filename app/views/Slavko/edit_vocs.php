    <main role="main" class="container">
	
		<p class="h1">Справочники</p>
		<hr>
		<div class="row">
		</div>		
		<form name="formvoc" method="POST" action="http://hmdoll.ru/public/test.php">
			<div class="form-group row">
				<label for="inputTypeVoc" class="col-sm-6 col-form-label">Наименование редактируемого справочника</label>
				<div class="col-sm-2">
					<select name="table" class="custom-select mr-sm-2" id="inputTypeVoc" onchange="this.form.submit()">
						<option selected>Выбрать...</option>
						<option value="statuses">Статус</option>
						<option value="types">Тип куклы</option>
						<option value="materials">Материалы</option>
					</select>		 
				</div>
			</div>
		</form>
		<hr>
			<form>
			  <div class="form-group row">
				<label for="inputNewItem" class="col-sm-3 col-form-label">Новый пункт</label>
				<div class="col-sm-5">
					<!--
					<input type="text" class="form-control" id="inpuNewItem" placeholder="Новый пункт справочника">
					-->

				</div>
				<div class="col-sm-4 text-right">
				
				  <button type="button" class="btn btn-warning"data-toggle="modal" data-target="#inputItemModal">Добавить элемент в справочник</button>
				</div>
			  </div>	
			
			</form>
		<hr>
		<p class="h4 text-center">Текущее состояние справочника </p>
		<hr>
		<table class="table table-hover">
		  <thead>
			<tr class="table-primary">
			  <th scope="col">#</th>
			  <th scope="col">Данные</th>
			  <th colspan="2" class="text-center">Действия</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <th scope="row">1</th>
			  <td>Игрушка</td>
			  <td><a href="#" class="btn btn-outline-success" role="button" aria-pressed="true">Редактировать</a></td>
			  <td><a href="#" class="btn btn-outline-danger" role="button" aria-pressed="true">Удалить</a></td>
			</tr>
			<tr>
			  <th scope="row">2</th>
			  <td>Зверушка</td>
			  <td><a href="#" class="btn btn-outline-success" role="button" aria-pressed="true">Редактировать</a></td>
			  <td><a href="#" class="btn btn-outline-danger" role="button" aria-pressed="true">Удалить</a></td>
			</tr>
			<tr>
			  <th scope="row">3</th>
			  <td>Коллекционная</td>
			  <td><a href="#" class="btn btn-outline-success" role="button" aria-pressed="true">Редактировать</a></td>
			  <td><a href="#" class="btn btn-outline-danger" role="button" aria-pressed="true">Удалить</a></td>
			</tr>
		  </tbody>
		</table>
		<hr>
		  
		  


    </main>