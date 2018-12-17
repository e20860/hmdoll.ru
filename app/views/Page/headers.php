<main role="main" class="container">
	
    <p class="h1">Заголовки страниц</p>
		<hr>
		<div class="row">
		</div>		
		<p class="h5 text-center">Заголовки и текст, появляющийся в верхней части страниц товаров </p>
		<hr>
		<table class="table table-hover">
		  <thead>
			<tr class="table-primary">
			  <th scope="col">#</th>
			  <th scope="col">Наименование</th>
			  <th scope="col" >Описание</th>
			  <th scope="col" >Действие</th>
			</tr>
		  </thead>
		  <tbody>
                      <?php foreach ($dataset as $key => $row):?>
			<tr>
			  <th scope="row" class="id"><?php echo $row['id'] ?></th>
                          <td><input type="text" class="header" value="<?php echo $row['header']; ?>" name="header"></td>
			  <td>
				<textarea cols="60" rows="4" class="descr"><?php echo $row['description']; ?>
				</textarea>
			  </td>
			  <td><button class="btn btn-outline-success save" role="button" aria-pressed="true">Сохранить</button></td>
			</tr>
                       <?php endforeach; ?>                        
		  </tbody>
		</table>
		<hr>
    </main>
	<script>
		$(".save").click(function(){
			var $row = $(this).parent().parent();
			var id = $row.find(".id").html(),
				header = $row.find(".header").val(),
				descr = $row.find(".descr").val();
			saveRow(id, header, descr);
			
		});
		function saveRow(vid, vheader, vdescr){
                    $.post('http://hmdoll.ru/page/savestr',
                    {id: vid, header: vheader, descr: vdescr},
                    function(){alert('Данные сохранены');})
                }
	</script>