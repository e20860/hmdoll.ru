    <main role="main" class="container">
        <div class="jumbotron">
            <div class="row">
                    <div class="col-sm-2">
                        <img src="/public/img/hmd_logo.gif" class="img-fluid" id="gal"  alt="logotype"> 
                    </div>
                    <div class="col-sm-10">
                            <p class="h1 text-center">Куклы ручной работы</p>
                            &nbsp;&nbsp;Здесь Вы можете найти замечательную куклу изготовленную для Вас. Все куклы производятся по оригинальным лекалам вручную. Мы вкладываем в каждую частичку своей души. Может какая-нибудь согреет Вас?
                    </div>
	    </div>
        </div>
        <div class="container">
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">

			<?php if(!empty($items)): ?>
                            <?php foreach ($items as $item) : ?>
                                <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm img-thumbnail max-width: 100px">
                                        <div class="card-header text-center"><p class="h5"><?php echo $item['name'] ?></p></div>
                                        <img class="card-img-top" src="<?php echo '/public/img/' . $item['picture'];  ?>" alt="Sheep">
                                        <div class="card-body">
                                            <p class="card-text"><?php echo $item['description']; ?></p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-outline-secondary" href="main/item?id=<?php echo $item['id']; ?>" role="button">Посмотреть</a>
                                                        <a class="btn btn-sm btn-outline-secondary" href="main/order?id=<?php echo $item['id']; ?>" role="button">Заказать</a>
                                                    </div>
                                                    <small class="text-muted"><?php echo $item['price'] .' руб.'; ?></small>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?> 
		  </div>
	        </div>
	    </div>
        </div>
    </main>