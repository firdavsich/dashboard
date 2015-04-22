<?php
/**
 * Created by PhpStorm.
 * User: Firdavs Murodov
 * Date: 4/20/15
 * Time: 9:03 AM
 */
require_once '../auth.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ftp admin">
    <meta name="author" content="Firdavs Murodov">
    <link rel="icon" href="../favicon.ico">
    <title>FTP admin</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/theme.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
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
                    <li><a href="?ftp-list">List users</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">manage <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href='?ftp-restart'>restart service</a></li>
                            <li class="divider"></li>
                            <li><a href="add_user.php">add user</a></li>
                            <li><a href="del_user.php">dell user</a></li>
                            <li><a href="ch_pass.php">change password</a></li>
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
        <?php
        // list ftp users
        function ftp_list() {
            $str=shell_exec('sudo ../run.sh ftpd_list');
            $arr = explode("\n",$str);
            for($i = 0; $i < count($arr); $i++)
            {
                echo $arr[$i]."<br />";
            }
        }

        function ftp_serv_restart(){
            $reload=exec("sudo ../run.sh ftpd_restart");
            echo $reload;
        }

        if (isset($_GET['ftp-list'])) {
            ftp_list();
        }
        elseif (isset($_GET['ftp-reload'])) {
            ftp_serv_reload();
        }
        elseif (isset($_GET['ftp-restart'])) {
            ftp_serv_restart();
        }
        ?>
    </div>
</div> <!-- /container -->
<script src="../js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
