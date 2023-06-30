<?php
$min = 9;
$max = 17;

// 參數定義
$min = 9;
$max = 17;
$total = 13;  // 球的個數


// 產生六個數字，放入陣列
$a_box = array();
for($i=1; $i<=$total; $i++) {
    $num = mt_rand($min, $max);   // 產生數字
    $a_box[] = $num;   // 放入盒子
}

// 排序
sort($a_box);

// 網頁上顯示
$pic = '';
foreach($a_box as $one) {
    $pic .= '<img src="images_majung/' . $one . '.gif" border="1">' . "\n";
}



$html = <<< HEREDOC
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Test</title>
</head>

<body>
<h2>我的幸運數字</h2>
<p>{$pic}
</p>
</body>
</html>
HEREDOC;

echo $html;
?>