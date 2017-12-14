<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
테스트페이지 입니다. <br><br>

<?php
include "./mysqlDBquery.php";
$mysqlDBquery = new mysqlDBquery();
$endResult = $mysqlDBquery->getCommentHistory();

print "<br> 등록날짜: " . $endResult[0].datetime_regist;
?>

</body>
</html>