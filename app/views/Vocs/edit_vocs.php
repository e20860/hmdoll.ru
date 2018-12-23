<main role="main" class="container">
     <p class="h1">Справочники</p>
     <hr>
     <div class="row">
     </div>		
     <form name="formvoc" >
             <div class="form-group row">
                     <label for="inputTypeVoc" class="col-sm-6 col-form-label">Наименование редактируемого справочника</label>
                     <div class="col-sm-2">
                             <select name="table" class="custom-select mr-sm-2" id="inputTypeVoc" >
                                 <?php foreach ($vocList as $voc): ?>
                                    <option 
                                        class ="optvoc"
                                        value="<?php echo $voc['alias'] ?>"
                                        <?php echo $voc['alias']==$currentVoc?'selected':''; ?>>
                                        <?php echo $voc['name']; ?>
                                    </option>
                                 <?php endforeach; ?>    
                             </select>		 
                     </div>
             </div>
     </form>
     <hr>
     <form>
        <div class="form-group row">
            <label for="inputNewItem" class="col-sm-3 col-form-label" 
                   id="inputLabel">Новый пункт</label>
            <div class="col-sm-5">
               <input type="text" class="form-control" id="inputNewItem" placeholder="Новый пункт справочника">
               <input type="hidden" id="itemId" value="0">
            </div>
            <div class="col-sm-4 text-right">
                <button type="button" class="btn btn-warning " id="saveBut">Сохранить</button>
            </div>
        </div>	
     </form>
     <hr>
     <p class="h4 text-center">Текущее состояние справочника </p>
     <hr>
     <table class="table table-hover">
       <thead>
             <tr class="table-primary">
               <th scope="col">#</th>
               <th scope="col">Данные</th>
               <th colspan="2" class="text-center">Действия</th>
             </tr>
       </thead>
       <tbody>
           <?php foreach ($vocContent as $key => $value): ?>
           <tr class="item">
               <th scope="row"><?php echo $value['id']; ?></th>
               <td><?php echo $value['name']; ?></td>
               <td><a href="#" class="btn btn-outline-success edit" role="button" aria-pressed="true">Редактировать</a></td>
               <td><a href="#" class="btn btn-outline-danger delete" role="button" aria-pressed="true">Удалить</a></td>
             </tr>
           <?php endforeach; ?>  
       </tbody>
     </table>
     <hr>
 </main>
<script type="text/javascript">
    var pattern = $("tbody > tr:first").clone();
    $("#saveBut").click(function() {
        var id = $("#itemId").val(),
        name = $("#inputNewItem").val();
        if(!name) {
            alert("Сохранять нечего, заполните данные!");
            return;
        }
        saveItem(id,name);
    });
    $(".edit").click(function(){
        editItem($(this));
    });
    
    $(".delete").click(function(){
        delItem($(this));
    });
    
    $(".optvoc").on('click', function() {
        var table = $(this).val();
        $.post('/vocs/changeVoc', {"vocname": table},
        function(data) {
            var arr = JSON.parse(data);
            refreshList(arr);
        });
    });
    
    function refreshList(array) {
        $("tbody > tr").remove();
        for(var i = 0; i< array.length; i++) {
            var row = pattern.clone();
            row.children()[0].innerHTML = array[i].id;
            row.children()[1].innerHTML = array[i].name;
            $("tbody").append(row);
        }
        $(".edit").click(function(){
            editItem($(this));
        });

        $(".delete").click(function(){
            delItem($(this));
        });
        
        $("#itemId").val('0');
        $("#inputNewItem").val('');
        $("#inputLabel").html('Новый пункт');

    }
    
    function editItem(obj) {
        // Получает id и наименование элемента, заполняет поля
        var id   = obj.parent().parent().children()[0].innerHTML;
        var name = obj.parent().parent().children()[1].innerHTML;
        $("#itemId").val(id);
        $("#inputNewItem").val(name);
        $("#inputLabel").html('Изменить значение');
    }
    
    function saveItem(id,text) {
        // Сохраняет отредактированную или новую запись элемента справочника
        var curVoc = $("#inputTypeVoc").val();
        //alert('Сохраняю в таблицу ' + curVoc + ' данные: id-> ' + id + ' текст-> ' + text);
        $.post('/vocs/saveVocItem', {"vocname": curVoc, "itemid": id, "itemdata": text},
        function(data) {
            var arr = JSON.parse(data);
            refreshList(arr);
        });
        
    }
    
    function delItem(obj) {
        // Удаляет элемент справочника
        var curVoc = $("#inputTypeVoc").val();
        var id   = obj.parent().parent().children()[0].innerHTML;
        //alert('Удаляю из таблицы ' + curVoc + ' данные: id-> ' + id);
        $.post('/vocs/delVocItem', {"vocname": curVoc, "itemid": id},
        function(data) {
            var arr = JSON.parse(data);
            refreshList(arr);
        });
        
    }
</script>