<?php
// 參數定義
$min = 1;
$max = 12;
$total = 6;  // 球的個數


// 產生六個數字，放入陣列
for($i=1; $i<=$total; $i++) {
    $num = mt_rand($min, $max);
    $a_box[] = $num;
}
// echo '<pre>';
// print_r($a_box);
// echo '</pre>';
// exit;


// 網頁上顯示
$pic = '';
foreach($a_box as $one) {
    $pic .= '<img src="images/' . $one . '.jpg">' . "\n";
}



// 補充說明
$i = 0;   // 0
$i = $i + 1;   // 1 
$i += 1;       // 2
$i++;          // 3

$s = '';
$s = $s . 'A';   // A
$s = $s . 'B';   // AB
$s = $s . 'C';   // ABC
$s = $s . 'D';   // ABCD

$s = '';
$s .= 'A';   // A
$s .= 'B';   // AB
$s .= 'C';   // ABC
$s .= 'D';   // ABCD


for($i=1; $i<=6; $i++) {
    // 1  2  3  4  5  6
}

for($i=0; $i<6; $i++) {
    // 0  1  2  3  4  5
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
<h1>幸運樂透數字產生器</h1>
{$pic}
</body>
</html>
HEREDOC;

echo $html;
?>