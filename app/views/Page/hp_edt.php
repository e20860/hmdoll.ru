    <?php 
        $item = (current($dataset['item']));
        $types = array_values($dataset['types']);
        $orders = array_values($dataset['orders']);
        $id = $dataset['id'];
    //debug($dataset);
    ?>

    <main role="main" class="container">
		<p class="h1 text-center">Редактирование элемента домашней страницы</p>
		<hr>
                <form method="post" action="/page/updatehpitem">
                  <input type="hidden" name="id" value="<?php echo $id ?>" >   
		  <div class="form-row">
			<div class="form-group col-md-3 text-center">
                            <img id="jpg" src="../img/<?php echo $item['img']; ?>" width="100%" class="image-fluid" >
			</div>
			<div class="form-group col-md-5">
			  <label for="inputFile">Изображение</label>
                          <input type="file" class="form-control" name="file" id="inputFile" accept="image/*">
			</div>
                        <input type="hidden" name="img" value="<?php echo $item['img']; ?>">
			<div class="form-grouop col-md-4">
			   <div class="form-row">
					<div class="form-group col-md-12">
					  <label for="inputType">Тип</label>
                                          <select id="inputType" name="type" class="form-control">
                                              <?php foreach ($types as $value): ?>
						<option <?php echo $item['type'] == $value?'selected':''; ?>><?php echo $value; ?></option>
                                              <?php endforeach; ?>
					  </select>
					</div>
				</div>
				<div class="form-row">
				<div class="form-group col-md-12">
					  <label for="inputOrd">Номер в элементе</label>
                                          <select id="inputOrd" name="ord" class="form-control">
                                              <?php foreach ($orders as $value): ?>
						<option <?php echo $item['ord'] == $value?'selected':''; ?>><?php echo $value; ?></option>
                                              <?php endforeach; ?>
					  </select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
					<label for="inputLink">Ссылка</label>
					  <input type="text" 
                                                 class="form-control" 
                                                 id="inputLink" 
                                                 name="link"
                                                 placeholder="Ссылка действия"
                                                 value="<?php echo $item['link']; ?>">
					</div>
				</div>
			</div>
		  </div>
		  <div class="form-row">
			<div class="form-group col-md-12">
			  <label for="inputHeader">Заголовок элемента</label>
			  <input type="text" 
                                 class="form-control" 
                                 name="header"
                                 id="inputHeader"
                                 value="<?php echo $item['header']; ?>">
			</div>
		  </div>
		  <div class="form-row">
			<div class="form-group col-md-12">
				<label for="content">Область редактирования содержимого</label>
				<textarea class="form-control" 
						  id="content" 
						  name="content"
						  rows="3">
                                    <?php echo $item['content']; ?>
				</textarea>
			<script>
                CKEDITOR.replace( 'content' );
            </script>
			</div>
		  </div>
		  <button type="submit" class="btn btn-primary">Сохранить</button>
		</form>



    </main>
    <script>
        $(function(){
        $("#inputFile").change(function(){
            //var fname = $(this).val().replace(/^.*(\\|\/|\:)/, '');
            var file_data = $(this).prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '/page/uploadimg',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response) {
                    fname = response;
                    $("#jpg").attr('src','../img/'+fname);
                },
                error: function(r,t, e){
                    alert('Ошибка: ' + e);
               }
            });
            //$("#jpg").attr('src','../img/'+fname);
            //alert("Выбран: " + fname );
        });
        });
    </script>
