<?php 

$path = dirname(__FILE__);
$file = file($path."/url.txt");
$code = http_response_code();
if ($_SERVER["QUERY_STRING"] == "type=json"){
    $arr = mt_rand( 0, count( $file ) - 1 );
    $imgpath  = trim($file[$arr]);
    $imginfo = getimagesize($imgpath);
    $width =  $imginfo[0];
    $height = $imginfo[1];
    $arr = array('url' => $imgpath, 'code' => $code ,'width'=> $width,'height'=> $height );
    echo json_encode($arr);   
    exit;
}else{
    $arr = mt_rand( 0, count( $file ) - 1 );
    $imgpath  = trim($file[$arr]);

    if (isset($_GET['charset']) && !empty($_GET['charset'])) {
        $charset = $_GET['charset'];
        if (strcasecmp($charset,"gbk") == 0 ) {
            $imgpath = mb_convert_encoding($imgpath,'gbk', 'utf-8');
        }
    } else {
        $charset = 'utf-8';
    }
    header("Content-Type: text/html; charset=$charset");
    die(header("Location: $imgpath"));
}
?>