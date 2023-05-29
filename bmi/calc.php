<?php
// $h = $_POST['height'];
// $w = $_POST['weight'];
$h = isset($_POST['height']) ? $_POST['height'] : '';
$w = isset($_POST['weight']) ? $_POST['weight'] : '';


// 計算 BMI
// $bmi = $w / (($h/100)*($h/100));
// $bmi = $w / (($h/100)**2);  // php7
$bmi = $w / pow($h/100, 2);


// 取兩位小數
// $bmi = floor($bmi*100)/100;  // 有夠難懂
// $bmi = round($bmi, 2);  
$bmi = number_format($bmi, 2);


// 判斷
$msg = '';
$pic = '';
$url = '';

if($bmi>=24) {
    $msg = '月巴月半';
    $pic = 's1.jpg';
    $url = 'page1.html';
}
elseif ($bmi<24 && $bmi>=22) {
    $msg = '過重';
    $pic = 's2.jpg';
    $url = 'page2.html';
}
elseif ($bmi<22 && $bmi>=17.5) {
    $msg = '標準';
    $pic = 's3.jpg';
    $url = 'page3.html';
}
elseif ($bmi<17.5){
    $msg = '太輕';
    $pic = 's4.jpg';
    $url = 'page4.html';
}
else {
    $msg = '程式一定出錯了';
    echo $msg;
    exit;
    // die($msg);
}


$html = <<< HEREDOC
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>BMI</h1>
    <p>BMI = {$bmi}</p>
    <p>{$msg}</p>
    <p><img src="images/{$pic}"></p>
    <p>建議 <a href="{$url}">點此處</a></p>
    <iframe src="{$url}" width="500" height="300"></iframe>
    <hr>
    <p>h = {$h}</p>
    <p>w = {$w}</p>
</body>
</html>
HEREDOC;

echo $html;
?>