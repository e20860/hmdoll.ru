   <main role="main" class="container">
    <p class="h1 text-center">Подробнее о кукле</p>
	<hr>
        
	<div class="row">
		<div class="col-sm-6">	
			<div class="card" style="width: 32rem;">
                            <img class="card-img-top" id="main-img" src="<?php echo IMAGES .'/'.($pics[1]); ?>" alt="Изображение №1">
			  <div class="card-body">
				<h5 class="card-title"><?php echo $one_item['name'] ?></h5>
				<p class="card-text"><?php echo $one_item['description'] ?></p>
				<a href="order?id=<?php echo $one_item['id']?>" class="btn btn-primary">Заказать</a>
			  </div>
			</div>
		</div>
		<div class="col-sm-1">
                    <?php foreach ($pics as $picture): ?>
		        <img class="img-fluid btn-pic" src="<?php echo IMAGES .'/'. $picture; ?>" alt="рисунок куклы">
			<p></p>
                    <?php endforeach;?>    
			<hr>
                        <p class="text-center">видео</p>
                        <img class="img-fluid btn-video" src="/public/img/vid_btn2.jpg" alt="Видюха">
			<p></p>
		</div>
		<div class="col-sm-5">
			<p class="h3"> Основные характеристики</p>
			<hr>
			<br>
			<ul>
			  <li>Тип куклы: <?php echo $one_item['type'] ?></li>
			  <li>Материал: <?php echo $one_item['material'] ?></li>
			  <li>Статус: <?php echo $one_item['status'] ?></li>
			  <li>Размеры: <?php echo $one_item['dimensions'] ?></li>
			</ul>
                        <p class="h4 text-left"><b>&nbsp;&nbsp;&nbsp;&nbsp;Цена: <?php echo $one_item['price'] ?> руб</b></p>
			<div class="text-right">
			<a href="order?id=<?php echo $one_item['id']?>" class="btn btn-primary">Заказать</a>
			</div>
			<hr>
			<p class="h4 text-center">Задать вопрос</p>
			<p>Наберите свой вопрос в поле, расположенном ниже и Вам обязательно ответят. Только не забудьте указать адрес Вашей электронной почты</p>
			<form>
			  <div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
				  <input type="text" readonly class="form-control-plaintext" id="staticEmail" placeholder="адрес Вашей почты">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="inputТехт" class="col-sm-2 col-form-label">Вопрос</label>
				<div class="col-sm-10">
				  <textarea class="form-control" id="inputТехт" rows="3" placeholder="Содержание вопроса"></textarea>
				</div>
			  </div>
			  <button type="submit" class="btn btn-secondary mb-2">Отправить</button>
			</form>
			
		</div>
	</div>
	
    </main>

<script>
	$('.btn-pic').click(function(){
	    $src = $(this).attr("src");
		$("#main-img").attr("src" , $src);
	});
	$('.btn-video').click(function() {
		$('#videoModal').modal('toggle');
	});
</script>
