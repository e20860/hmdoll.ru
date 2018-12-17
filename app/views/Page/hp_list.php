    <main role="main" class="container">
		<p class="h1">Домашняя страница сайта</p>
		<hr>
		<div class="row">
		</div>		
		<p class="h5 text-center">Содержимое карусели, описания страниц и маркетинговых статей </p>
		<hr>
		<table class="table table-hover">
		  <thead>
			<tr class="table-primary">
			  <th scope="col">#</th>
			  <th scope="col">Изображение</th>
			  <th scope="col">Размещение</th>
			  <th scope="col" >№п/п</th>
			  <th scope="col" >Заголовок</th>
			  <th scope="col">Содержимое</th>
			  <th scope="col">Ссылка</th>
			  <th scope="col">Действие</th>
			</tr>
		  </thead>
		  <tbody>
                      <?php foreach ($dataset as $k => $v):?>
			<tr>
			  <th scope="row" class="id"><?php echo $k?></th>
			  <td width="10%"><img width="80%" src="../img/<?php echo $v['img']?>"></td>
			  <td><?php echo $v['type']?></td>
			  <td><?php echo $v['ord']?></td>
			  <td><?php echo $v['header']?></td>
			  <td width="20%"><?php echo $v['content']?></td>
			  <td><?php echo $v['link']?></td>
			  <td><a href="/page/edithpitem?id=<?php echo $k?>"  class="btn btn-outline-success" role="button" aria-pressed="true">Править</a></td>
			</tr>
                      <?php endforeach;?>
                  </tbody>
		</table>
		<hr>
    </main>