<main role="main" class="container">
    <p class="h1 text-center">Подробнее о товаре</p>
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
			<ul>
			  <li>Тип изделия: <?php echo $one_item['type'] ?></li>
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
			<p>Наберите свой вопрос в поле, расположенном ниже и Вам обязательно ответят.</p>
                        <form id="sendForm">
			  <div class="form-group row">
				<label for="uName" class="col-sm-2 col-form-label">Имя</label>
				<div class="col-sm-10">
                                    <input type="text"  class="form-control" name="uName" id="uName" placeholder="Как к Вам обращаться" required>
				</div>
			  </div>
			  <div class="form-group row">
				<label for="uEmail" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
                                    <input type="email"  class="form-control" name="uEmail" id="uEmail" placeholder="адрес Вашей почты" required>
				</div>
			  </div>
			  <div class="form-group row">
				<label for="uQuestion" class="col-sm-2 col-form-label">Вопрос</label>
				<div class="col-sm-10">
                                    <textarea class="form-control" name="uQuestion" id="uQuestion" rows="3" placeholder="Содержание вопроса" required></textarea>
				</div>
			  </div>
                            <div class="g-recaptcha" data-sitekey="6LfdrIYUAAAAALnjHC0sB7jT2nqLDcmhztuZx5pi">
                            </div>
                            <button type="submit" id="sendMess" class="btn btn-secondary mb-2">Отправить</button>
			</form>
			
		</div>
	</div>
	
    </main>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
	$('.btn-pic').click(function(){
	    $src = $(this).attr("src");
		$("#main-img").attr("src" , $src);
	});
	$('.btn-video').click(function() {
		$('#videoModal').modal('toggle');
	});
</script>
<script>
    $("#sendMess").click( function(e){
        e.preventDefault();
        var errors = '',
            $form = $("#sendForm"),
            $name = $("#uName").val(),
            $email= $("#uEmail").val(),
            $quest= $("#uQuestion").val();
        if (!$name.length || !$quest.length) {
            errors +='Заполните, пожалуйста покрасневшие поля ';
        }
        if (($email.indexOf('@')== -1) || ($email.indexOf('.')==-1)) {
            errors += ' Неверный email';
        }
        
        if (errors.length >0){
            alert(errors);
            return false;
        }
        // console.log('Ошибки проверены'); http://hmdoll.ru
        $.ajax({
               url: '/main/question',
               type: 'post',
               data: $form.serialize(),
               success: function(response){
                   alert(response);
                   window.location.reload();
              },
              error: function(e) {
                  console.log(e);
                  alert('Сообщение не отправлено. Ошибка');
              }
       }); // end ajax({...})
        
    });
</script>
