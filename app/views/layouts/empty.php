<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Интернет-магазин продажа кукол ручной работы">
    <meta name="author" content="Е. Славко">
    <link rel="icon" href="../favicon.ico">
    <title><?php echo isset($title) ? $title:'Магазин HMDoll'; ?></title>
    <?php vendor\hmd\core\base\View::getMeta()?>
    <!-- Bootstrap core CSS -->
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/public/css/navbar-top.css" rel="stylesheet">
    <?php 
        if(isset($stylefile)) {
            if(!empty($stylefile)) {
                echo "<!-- Additional styles fo this template  -->";
                include_once $stylefile;
            }
        }
    ?>
  </head>
  <body>
    <?php 
        if(isset($modalfile)) {
            if(!empty($modalfile)) {
                include_once $modalfile;
            }
        }
    ?>
    <?=$content?>

    <!-- Scripts for default -->  
    <script src="/public/js/jquery_3_2_1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="/public/bootstrap/js/bootstrap.min.js"></script>
    <?php 
        foreach ($scripts as $script) {
            echo $script;
        }
    ?>
  </body>
</html>
