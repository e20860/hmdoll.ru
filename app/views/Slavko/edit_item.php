<main role="main" class="container">
    <?php if(isset($dataset)): ?>
    <?php 
        $item_id = array_keys($dataset['item'])[0];
        $_SESSION['item_id'] = $item_id;
        $item = $dataset['item'][$item_id];
        $hdr = $item_id == 0 ? 'Новое изделие' : 'Редактирование информации об изделии';
        $articules = $dataset['articules'];
        $types = $dataset['types'];
        $statuses = $dataset['statuses'];
        $materials = $dataset['materials'];
        $images = ($dataset['images']);
    ?>
    <p class="h1 text-center"><?php echo $hdr; ?></p>
    <hr>

    <form method="post" action="/slavko/saveItem">
        <input type="hidden" name="id" value="<?php echo $item_id?>">
        <div class="form-group row">
            <label for="inputArticul" class="col-sm-2 col-form-label text-left">Артикул</label>
            <div class="col-sm-4">
                <select class="custom-select mr-sm-4" id="inputArticul" name="articul" required>
                 <option <?php echo ($item_id==0 ?  'selected': ''); ?>>Выбрать...</option>
                    <?php foreach ($articules as $k=>$v):  ?>   
                       <option value="<?php echo $k ?>"<?php echo ($k==$item['articul'] ?  ' selected': ''); ?>><?php echo $v ?></option>
                    <?php endforeach; ?> 
                      </select>		 
            </div>
            <label for="inputType" class="col-sm-2 col-form-label text-right">Тип</label>
            <div class="col-sm-4">
                <select class="custom-select mr-sm-4" id="inputType" name="type" required>
                    <?php foreach ($types as $k=>$v):  ?> 
                       <option value="<?php echo $k ?>"<?php echo ($k==$item['type'] ?  ' selected': ''); ?>><?php echo $v['name'] ?></option>
                    <?php endforeach; ?>            
                </select>		 
            </div>
        </div>
        <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Наименование</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputName" 
                     placeholder="Наименование" name="name" 
                     value="<?php echo $item['name']; ?>">
            </div>

        </div>
        <div class="form-group row">
            <label for="inputDesc" class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description" id="inputDesc" rows="2" 
                        placeholder="Описание"><?php echo $item['description']; ?>
              </textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputStatus" class="col-sm-2 col-form-label">Статус</label>
            <div class="col-sm-2">
                <select class="custom-select mr-sm-2" id="inputStatus" name="status" required>
                    <option <?php echo ($item_id==0 ?  'selected': ''); ?>>Выбрать...</option>
                    <?php foreach ($statuses as $k=>$v):  ?> 
                        <option value="<?php echo $k ?>"<?php echo ($k==$item['status'] ?  ' selected': ''); ?>><?php echo $v ?></option>
                    <?php endforeach; ?>            
                </select>		 
            </div>

            <label for="inputDim" class="col-sm-2 col-form-label text-right">Размеры</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="inputDim" 
                     placeholder="Размеры куклы" name="dimensions"
                     value="<?php echo $item['dimensions']; ?>">
            </div>
            <div class="col-sm-2">
            <label for="inputMaterials" class="col-sm-2 col-form-label text-right">Материалы</label>
            </div>
            <div class="col-sm-2">
                <select class="custom-select mr-sm-2" id="inputMaterials" name="materials" required>
                        <option <?php echo ($item_id==0 ?  'selected': ''); ?>>Выбрать...</option>
                        <?php foreach ($materials as $k=>$v):  ?> 
                            <option value="<?php echo $k ?>"<?php echo ($k==$item['material'] ?  ' selected': ''); ?>><?php echo $v ?></option>
                        <?php endforeach; ?>            
                </select>		 
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPrice" class="col-sm-2 col-form-label">Цена</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="inputPrice" 
                     placeholder="Цена в рублях" name="price"
                     value="<?php echo $item['price']; ?>">
            </div>
            <div class="col-sm-5">
            </div>
            <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1"
                           name="ready" <?php echo $item['ready']?'checked':''; ?> >
                    <label class="form-check-label" for="gridCheck1">
                      Разместить на витрине магазина
                    </label>
              </div>
            </div>
        <hr>
        <div class="form-group row">
            <p class="h4">Изображения для витрины (не более 6)</p>
        </div>
        <div class="form-group row items">
        <?php foreach ($images as $key => $value): ?>
            <div class="col-sm-2 item">
                    <div class="card" style="">
                      <img class="card-img-top" src="<?php echo '../img/' . $value['file']?>" alt="image #1">
                      <div class="card-body">
                            <p class="card-title"><?php echo 'Фото №' . $value['num'] ?></p>
                            <button type="button" class="btn btn-secondary del">Удалить</button>
                      </div>
                    </div>				
            </div>
        <?php endforeach; ?>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-sm-4 text-left">
                <input type="file" id="fpic" accept="image/*">
                <p><small>Выбрать файл фото</small></p>
            </div>
            <div class="col-sm-2 text-left">
                <button type="button" id="upload" class="btn btn-success">Загрузить фото</button>
            </div>
            <div class="col-sm-4">
                
            </div>
            <div class="col-sm-2 text-right">
                <button type="button" class="btn btn-danger delAll">Удалить все фото</button>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-sm-12 text-right">
              <button type="submit" class="btn btn-primary">Сохранить данные об изделии</button>
            </div>
        </div>
    </form>

    <?php endif;?>

</main>
<script>
    // Запоминаем карточку товара для последующей работы
    var tpl = $(".item:first").clone();
    //Кнопка закачки изображений на сервер 
    $('#upload').click(function() {
        var file_data = $('#fpic').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
                    url: '/slavko/upload',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(response){
                        var finfo = $.parseJSON(response);
                        var phnum  = 'Фото №' + finfo.num;
                        var fname = '../img/' + finfo.file;
                        $(".items").append(tpl.clone());
                        $(".item:last img").attr('src',fname);
                        $(".item:last .card-title").html(phnum);
                        $(".item:last .del").on('click', deletepicture);
                    },
                    error: function(r,t, e){
                        alert('Ошибка: ' + e);
                    }
                    
         });
    });
    
    //Кнопка удаления внутри карточки
    $(".del").click(deletepicture);
    // Удалить все картинки
    $(".delAll").click(function(){
        $(".item").remove();
        $.get('/slavko/clearImages');
    });
    // Удаление карточки с картинкой изделия
    function deletepicture() {
        var numpic = $(this).parent().find(".card-title").html().slice(-1);
        $.get('/slavko/delimg',{num: numpic},function(data){
            $(".item").remove(); 
            var pics = $.parseJSON(data);
            $.each(pics, setcard);
        });
    };
    // Навешиваем на новую карточку атрибутику (фото, подпись, обработчик)
    function setcard(key,value) {
        $(".items").append(tpl.clone());
        var fname = '../img/' + value.file,
            phnum  = 'Фото №' + value.num;
        $(".item:last img").attr('src',fname);
        $(".item:last .card-title").html(phnum);
        $(".item:last .del").on('click', deletepicture);
    }
    
    
</script>