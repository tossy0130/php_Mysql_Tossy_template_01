<?php

ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダー フォーム</title>
</head>

<body>

    <form action="calender_02.php" method="post">
        お名前
        <div><input type="text" name="name" placeholder="夏目 智徹"></div>
        電話番号
        <div><input type="tel" name="number" placeholder="09012349876"></div>
        人数
        <div><input name="member"></div>
        日付
        <div>
            <input type="date" name="day" list="daylist" min="">
        </div>


        <div class="submit">
            <input type="submit" value="送信">
        </div>
        <div class="reset">
            <input type="reset" value="リセット">
        </div>
    </form>

</body>

</html>