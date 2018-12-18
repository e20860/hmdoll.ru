<?php 
$carouselle = $dataset['carouselle'];
$subheader = $dataset['subheader'];
$article = $dataset['article'];
$buttons = $dataset['buttons'];
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
        <?php foreach ($carouselle as $key => $value):?>    
          <div class="carousel-item <?php echo $key == 1? ' active':''; ?>">
            <img class="first-slide h-100" src= "<?php echo '/public/img/' . $value['img']; ?>" alt="N slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1><?php echo $value['header']; ?></h1>
                <p><?php echo $value['content']; ?></p>
                <p><a class="btn btn-lg btn-primary" href="<?php echo $value['link']; ?>" role="button"><?php echo $buttons[$key]; ?></a></p>
              </div>
            </div>
          </div>
        <?php endforeach;?>    
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Назад</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Вперёд</span>
        </a>
      </div>
      <!-- Marketing messaging and featurettes
      ================================================== -->
      <div class="container marketing">
        <!-- Three columns of text below the carousel -->
        <div class="row">
            <?php foreach ($subheader as $key => $value):?> 
            <div class="col-lg-4">
                <img class="rounded-circle" src="/public/img/<?php echo $value['img']; ?>" alt="image" width="140" height="140">
                <h2><?php echo $value['header']; ?></h2>
                <p><?php echo $value['content']; ?></p>
                <p><a class="btn btn-secondary" href="<?php echo $value['link']; ?>" role="button"><?php echo $buttons[$key]; ?>&raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <?php endforeach;?> 
        </div><!-- /.row -->
        <!-- START THE FEATURETTES -->
        <hr class="featurette-divider">
        <?php foreach ($article as $key => $value):?>
        <div class="row featurette">
            <div class="col-md-7 <?php echo ($key%2)? '':' order-md-2'?>">
                <h2 class="featurette-heading"><a href="<?php echo $value['link']; ?>" class="light"><?php echo $value['header']; ?></a></h2>
                <p class="lead"><?php echo $value['content']; ?></p>
            </div>
            <div class="col-md-5 <?php echo ($key%2)? '':' order-md-1'?>">
               <img class="featurette-image img-fluid mx-auto" src="/public/img/<?php echo $value['img']; ?>" alt="image">
            </div>
        </div>
        <hr class="featurette-divider">
        <?php endforeach;?>
        <!-- /END THE FEATURETTES -->
      </div><!-- /.container -->
