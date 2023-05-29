<?php


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
    <form method="post" action="calc.php">
        <p>身高：<input type="text" size="2" name="height"> (公分)</p>
        <p>體重：<input type="text" size="2" name="weight"> (公斤)</p>
        <p><input type="submit" value="計算BMI"></p>
    </form>
    
    <hr />

    <h1>更好的寫法：加上輸入限制</h1>
    <form method="post" action="calc.php">
        <p>身高：<input type="text" size="2" name="height" required pattern="^[12][0-9]{2}$" title="請輸入正確的身高"> (公分)</p>
        <p>體重：<input type="text" size="2" name="weight" required pattern="^[1-9][0-9]{1,2}$" title="請輸入正確的體重"> (公斤)</p>
        <p><input type="submit" value="計算BMI"></p>
    </form>
</body>
</html>
HEREDOC;

echo $html;
?>