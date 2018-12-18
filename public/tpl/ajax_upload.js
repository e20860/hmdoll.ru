
/*
AJAX и PHP: загрузка файла

Пример того как осуществить загрузку файла через PHP и jQuery ajax. Для начала необходимо создать HTML элемент для загрузки файла.
*/
<input id="sortpicture" type="file" name="sortpic" />
<button id="upload">Upload</button>

//Далее необходимо дописать JS код:

$('#upload').on('click', function() {
    var file_data = $('#sortpicture').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $.ajax({
                url: 'upload.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response){
                    alert("Done!");
                }
     });
});

//Теперь приступим к PHP скрипту, где загрузим файл на сервер, upload.php:

<?php

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
    }

?>

//Ну и естественно не забываем подключить библиотеку jquery. В итоге всё прекрасно работает.
