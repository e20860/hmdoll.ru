<?php
echo 'ОПЛАТА И ДОСТАВКА' .'<br>';
$jp =  $_SERVER['HTTP_REFERER'];
$rjp = parse_url($jp);
$rjpp = $rjp['path'];
echo 'Путь из сервера: ' . $jp . ',  parse_url[path]: ' . $rjpp;
echo "<br><a href='{$rjpp}'>Возврат</a>";

