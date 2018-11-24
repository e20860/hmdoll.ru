<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Интернет-магазин продажа кукол ручной работы">
    <meta name="author" content="Е. Славко">
    <link rel="icon" href="../favicon.ico">
    <title>Магазин HMDoll</title>
    <?php vendor\hmd\core\base\View::getMeta()?>
    <!-- Bootstrap core CSS -->
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/public/css/navbar-top.css" rel="stylesheet">
    <link href="/public/css/showitem.css" rel="stylesheet"> 
  </head>
  <body>
       <!--        модальное окно -->
	<div class="modal" id="videoModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Видео куклы</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body text-center">
			<video width="400" height="300" autoplay="autoplay" loop="loop" controls="controls" >
				<source src="../video/video1.mp4" type="video/mp4" />
			</video>
		  </div>
		  <div class="modal-footer">
		  </div>
		</div>
	  </div>
	</div>	
        <!-- конец модального окна -->
      
        <?php new vendor\hmd\widgets\menu\Menu();?>
        <?=$content?>
     
      <script src="/public/js/jquery_3_2_1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="/public/bootstrap/js/bootstrap.min.js"></script>
    <?php 
        foreach ($scripts as $script) {
            echo $script;
        }
    ?>
    <?php 
        foreach ($styles as $style) {
            echo $style;
        }
    ?>
    
  </body>
</html>
