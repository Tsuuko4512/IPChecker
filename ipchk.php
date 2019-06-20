<?php
    $get_ip=$_GET['ip'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $ua = $_SERVER['HTTP_USER_AGENT'];

    # mode=ipのときにip文字列のみ返す
    if($_GET['mode']=='ip'){
        echo $ip."\n";
        exit();
    }
    # mode=hostのときにhost文字列のみ返す
    elseif($_GET['mode']=='host'){
        echo gethostbyaddr($ip)."\n";
        exit();
    }
    # mode=jsonのときに{"ip":"IP ADDR","host":"HOST"}を返す
    elseif($_GET['mode']=='json'){
        $array = array('ip' => $ip, 'host' => gethostbyaddr($ip));
        echo json_encode($array)."\n";
        exit();
    }
    # curlでアクセスされた場合はip文字列のみ返す
    elseif(strpos($ua,'curl') !== false){
        echo $ip."\n";
        exit();
    }
?>

<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UFT-8">
        <meta name="viewport" content="width=device-width">
        <title>IP Changed Checker</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="shortcut icon" href="icon/favicon.ico">
        <link rel="apple-touch-icon" href="icon/ipchk_icon_ios.png" sizes="180x180">

        <!-- Twitterカード表示用 -->
        <meta name="twitter:card" content="summary" />
        <?php
        $HOST=$_SERVER["HTTP_HOST"];
        echo '<meta property="og:url" content="http://'.$HOST.'/ipchk.php" />'."\n";
        echo '<meta property="og:image" content="http://'.$HOST.'/icon/ipchk_icon.png" />'."\n";
        ?>
        <meta property="og:title" content="IP Changed Checker" />
        <meta property="og:description" content="ipアドレスやhostの確認、IPが変更されているかを判定します。" />
        <!---->

        <style type="text/css">
        .main_text_m{
            font-size:calc(18px + 0.5vw);
        }
        .main_text_s{
            font-size:calc(15px + 0.5vw);
        }
        .main_text_l{
            font-size:calc(25px + 0.5vw);
        }
        .center{
            text-align:center;
        }
        .footer_text{
            font-size:calc(15px + 0.5vw);
        }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1" href="/ipchk.php">IP Changed Checker</a>
        </nav>
        <?php
        if ($_GET['ip']&&$ip==$get_ip) $status="変更されていません<br>";
        else if($_GET['ip']) $status="変更されています<br>$get_ip=>$ip";
        else $status="<br>";
        ?>
        <div class="center m-3">
            <p class="main_text_m">IPアドレス : <?=$ip?></p>
            <p class="main_text_m">ホスト : <span class="main_text_s"><?=gethostbyaddr($ip)?></span></p>
            <p class="main_text_l"><?=$status?><br></p>
            <form action = "ipchk.php" method = "get">
                <input type = "hidden" name ="ip" value="<?=$ip?>"><br/>
                <p><input type = "submit" value ="送信" class="btn btn-primary py-4" style="width:200px;font-size: 25px;"></p>
            </form>
            <p><input type="button" value="Reset" onClick="document.location='ipchk.php';" class="btn btn-secondary px-5"></p>
            <footer>
                <br>
                <hr>
                <p class="footer_text">Twitter : <a href="https://twitter.com/_Tsuuko_">@_Tsuuko_</a></p>
            </footer>
        </div>
    </body>

</html>
