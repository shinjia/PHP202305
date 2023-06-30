<?php
$total = isset($_GET['total']) ? $_GET['total'] : 10;

$a_lastname = array('趙','錢','孫','李','周','吳','鄭','王','陳','林','黃','張'
,'張','張','張','張','張','張'
,'陳','陳','陳','陳','陳','陳','陳','陳');

$a_firstname1 = array('雄','錢','孫','李','周','吳','鄭','王','陳','林','黃','張');
$a_firstname2 = array('','','','','','','','','趙','錢','孫','李','周','吳','鄭','王','陳','林','黃','張');

$str = '';
for($i=0; $i<$total; $i++) {
    $nn1 = $a_lastname[ array_rand($a_lastname,1) ];
    $nn2 = $a_firstname1[ array_rand($a_firstname1,1) ];
    $nn3 = $a_firstname2[ array_rand($a_firstname2,1) ];

    $full_name = $nn1 . $nn2 . $nn3;
    $str .= $full_name . '、';
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
    {$str}
</body>
</html>
HEREDOC;

echo $html;
?>