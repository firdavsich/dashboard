<?php
/**
 * Created by PhpStorm.
 * User: Firdavs Murodov
 * Date: 4/20/15
 * Time: 9:15 AM
 */
require_once '../auth.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="squid del block">
    <meta name="author" content="Firdavs Murodov">
    <link rel="icon" href="../favicon.ico">
    <title>Squid admin | del block</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <?php
    if ($theme == 'dark') {
        echo '<link href="../css/theme_dark.css" rel="stylesheet">';
    }
    else {
        echo '<link href="../css/theme_light.css" rel="stylesheet">';
    }
    ?>
</head>
<body>
<?php
if ($theme == 'dark') {
    echo '<nav class="navbar navbar-inverse navbar-fixed-top">' ;
}
else {
    echo '<nav class="navbar navbar-default navbar-fixed-top">' ;
}
?>
<div class="container">
        <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Dashboard</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php?block-list">List blocked</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">manage <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="add_block.php">add block</a></li>
                            <li><a href="del_block.php">del block</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../">exit</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
<div class="container">
    <div class="starter-template">
        <p>Del block</p>
        <?php
        // list blocked sites
        function block_list() {
            $blocked = file("deny.txt");
            foreach($blocked as $key => $value)
            {
                echo "$key)  $value <br />";
            }

        }

        if (isset($_GET['block-list'])) {
            block_list();
        }
        ?>

        <?
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $blockstringtmp=$_POST['inputid'];
            $blockfile = 'deny.txt';
            $list = array();      //для хранения открытого файла
            $list = file($blockfile) or die('Не открывается'); // текстовик в массив
            unset($list[$blockstringtmp]); // удаляем шестую и восьмую строчки
            // Открываем фаил, сохраняем в нём всё что осталось
            $f = fopen($blockfile, 'w+');
            flock($f, LOCK_EX);
            foreach($list as $string)
            {
                fwrite($f, $string);
            }
            flock($f, LOCK_UN);
            fclose($f);
        }
        unset($blockstringtmp)
        ?>
        <form  method="POST" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="name" name="inputid" class="form-control" placeholder="id from block list to remove" required autofocus>
            <div class="checkbox">
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">submit</button>
        </form>
    </div>
</div> <!-- /container -->
<script src="../js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
