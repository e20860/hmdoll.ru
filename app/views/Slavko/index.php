    <main role="main" class="container">
	<p class="h1 text-center">Административная панель</p>
	<hr>
	<div class="row">
		<div class="col-sm-3">
			<p class="h3">Функции</p>
			<hr>
			<p class="h5">Настройки:</p>
			<button type="button" id="appset" class="btn btn-outline-secondary btn-block sl">Приложения</button>
			<button type="button" id="dbset" class="btn btn-outline-secondary btn-block sl">Базы данных</button>
			<hr>
			<p class="h5">Протоколы:</p>
                        <button type="button" id="accsvrlog" class="btn btn-outline-secondary btn-block sl">Доступа</button>
                        <button type="button" id="errsvrlog" class="btn btn-outline-secondary btn-block sl">Ошибок сервера</button>
                        <button type="button" id="errapplog" class="btn btn-outline-secondary btn-block sl">Ошибок приложения</button>
                        <button type="button" id="maillog" class="btn btn-outline-secondary btn-block sl">Почты</button>
			<hr>
		</div>
		<div class="col-sm-9">
                    <form method="post" action="\slavko\savelogs">
                    <div class="form-group">
			<label for="txtedt">Область редактирования содержимого</label>
			<textarea class="form-control" 
				  id="txtedt" 
				  name="txtedt"
				  rows="15">
			</textarea>
                    </div>
                    <input type="hidden" id="fname" name="fname" value="">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
			
		</div>
	</div>
           <script>
                CKEDITOR.replace( 'txtedt' );
            </script>

    </main>
<script>
    $(".sl").click(function() {
        var $txt = $(this).attr('id');
        $("#fname").val($txt);
        $.get(
           'http://hmdoll.ru/slavko/getfile',
           {fname:  $txt},
           function(data) {
               CKEDITOR.instances.txtedt.setData(data);
           }
        );
     });
</script>