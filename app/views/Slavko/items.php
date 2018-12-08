    <main role="main" class="container">
		<div class="row">
			<div class="col-sm-8">
                            <p class="h1"><?php echo 'Тип изделия: ' . (trim($item_name))?> </p>
			</div>
			
			<div class="col-sm-2 text-right align-middle">
				<br>
				<a class="btn btn-primary" href="/slavko/addItem?item=<?php echo $item_type?>" role="button">Добавить...</a>
			</div>
		</div>
		<hr>
		<div class="row text-center">
                    <div class="col-sm-1"><strong>#id</strong></div>
			<div class="col-sm-1"><strong>Изобр</strong></div>
			<div class="col-sm-2"><strong>Артикул</strong></div>
			<div class="col-sm-2"><strong>Наименование</strong></div>
			<div class="col-sm-1"><strong>Цена</strong></div>
			<div class="col-sm-1"><strong>Виден</strong></div>
			<div class="col-sm-4"><strong>Действие</strong></div>
		</div>	
		<hr>
                <?php foreach($items as $item):?>                
                    <div class="row align-middle">
                            <div class="col-sm-1"><?php echo $item['id']; ?></div>
                            <div class="col-sm-1">
                                    <img class="img-fluid" src="<?php echo '../img/' . $item['picture'];?>">
                            </div>
                            <div class="col-sm-2"><?php echo $item['articul']; ?></div>
                            <div class="col-sm-2"><?php echo $item['name']; ?></div>
                            <div class="col-sm-1"><?php echo $item['price']; ?></div>
                            <div class="col-sm-1"><?php echo $item['ready']?'Да':'Нет'; ?></div>
                            <div class="col-sm-2 text-center">
                                    <a class="btn btn-secondary btn-sm" href="/slavko/editItem?id=<?php echo $item['id']; ?>" role="button">Редакт</a>
                            </div>
                            <div class="col-sm-2 text-center">
                                    <a class="btn btn-danger btn-sm" href="/slavko/delItem?id=<?php echo $item['id']; ?>" role="button">Удалить</a>
                            </div>
                    </div>	
                    <hr>
                <?php endforeach;?>
		<hr>
		
    </main>
