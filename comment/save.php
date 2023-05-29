<?php
$nickname = isset($_POST['nickname']) ? $_POST['nickname'] : ''; 
$comment  = isset($_POST['comment'])  ? $_POST['comment'] : '';

// 系統設定：時區
ini_set( 'date.timezone', 'Asia/Taipei');

// email 設定 (建議在 php.ini 中做永久的設定)
ini_set('SMTP','msa.hinet.net');
ini_set('smtp_port',25);
ini_set('sendmail_from', 'xxxxx@gmail.com');

// 設定
$is_mail = false;
$is_line = true;


// 取得現在時間
$now = date('Y-m-d H:i:s', time());


// $comment = nl2br($comment);
$data = <<< HEREDOC
時間：{$now}
姓名：{$nickname}
留言：{$comment}
---------------------------------------------------

HEREDOC;

// 簡單留言
// file_put_contents('data.txt', $data, FILE_APPEND);

// 自動建立資料夾
$dir = 'save';
if(!is_dir($dir)) {
    mkdir($dir, 777);
}


// 檔案名稱
$filename = $dir . '/data_' . date('Ymd', time()) . '.txt';


// 方法一：留言寫入(新增在後面)
// file_put_contents($filename, $data, FILE_APPEND);


// 方法二：新留言放前面
if(!file_exists($filename)) {
    file_put_contents($filename, '');
}

$old = file_get_contents($filename);
$new = $data . $old;
file_put_contents($filename, $new);


// 寄 email 通知
if($is_mail) {
    $to = 'xxxx@gmail.com';
    $title = '有新留言';

    mail($to, $title, $data);
}


if($is_line) {
    // Line Notify: PHP_LINE
    $token = '****************';  // 更換自己的 token

    $url = "https://notify-api.line.me/api/notify";

    $headers = array(
    'Content-Type: multipart/form-data',
    'Authorization: Bearer ' . $token);

    // $message = array('message' => $data);
    $message = array(
        'message' => $data,
        'imageThumbnail' => 'https://placekeanu.com/240/160',
        'imageFullsize' => 'https://placekeanu.com/600/400',  
        'imageFile' => curl_file_create('D:\\xampp\htdocs\myweb\comment\dog.png'),
        'stickerPackageId' => 446,
        'stickerId' => 1988
        );


    $ch = curl_init();
    curl_setopt($ch , CURLOPT_URL , $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    $result = curl_exec($ch);
    curl_close($ch);
}



$html = <<< HEREDOC
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment</title>
</head>
<body>
    <h1>意見留言</h1>
    <p>已收到！</p>

</body>
</html>
HEREDOC;

echo $html;
?>