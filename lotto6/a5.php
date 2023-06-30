<?php
// 參數定義
$min = 1;
$max = 9;
$total = 6;  // 球的個數

// 自訂函式
function ball_exist($n, $a) {
    // $n 數值是否在 $a 陣列裡
    $found = false;
    foreach($a as $one) {
        if($one==$n) {
            $found = true;
        }
    }
    return $found;
}


// 產生六個數字，放入陣列
$a_box = array();
$str_check = '';
for($i=1; $i<=$total; $i++) {
    do {
        $num = mt_rand($min, $max);   // 產生數字
        $str_check .= $num . ' ';

    } while( ball_exist($num, $a_box) );  // 盒子已經有了$num

    $a_box[] = $num;   // 放入盒子
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



// 排序
sort($a_box);

$pic_sort = '';
foreach($a_box as $one) {
    $pic_sort .= '<img src="images/' . $one . '.jpg">' . "\n";
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
<p>排序前 {$pic}</p>
<p>排序後 {$pic_sort}</p>
<hr>
<p>檢查每次抽出的數字：{$str_check}</p>
</body>
</html>
HEREDOC;

echo $html;
?>