<?php
// 參數定義
$min = 1;
$max = 20;

// 產生六個數字
$num1 = mt_rand($min, $max);
$num2 = mt_rand($min, $max);
$num3 = mt_rand($min, $max);
$num4 = mt_rand($min, $max);
$num5 = mt_rand($min, $max);
$num6 = mt_rand($min, $max);

$pic1 = 'images/' . $num1 . '.jpg';
$pic2 = 'images/' . $num2 . '.jpg';
$pic3 = 'images/' . $num3 . '.jpg';
$pic4 = 'images/' . $num4 . '.jpg';
$pic5 = 'images/' . $num5 . '.jpg';
$pic6 = 'images/' . $num6 . '.jpg';



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
<h1>幸運樂透數字產生器</h1>
    <img src="{$pic1}">
    <img src="{$pic2}">
    <img src="{$pic3}">
    <img src="{$pic4}">
    <img src="{$pic5}">
    <img src="{$pic6}">
</body>
</html>
HEREDOC;

echo $html;
?>