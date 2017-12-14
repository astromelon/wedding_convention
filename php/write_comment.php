<?php
/**
 * Created by PhpStorm.
 * User: astromelon
 * Date: 2017-01-03
 * Time: 오후 2:40
 */

include 'db_connetion.php';

// 1. 데이터 정의
// json 파싱
$request_body = file_get_contents('php://input');
$postInfo = json_decode(stripcslashes($request_body), true);
$name_register = $postInfo['name_register'];
$content = $postInfo['content'];

$code = 500;        // 성공유무 flag(성공:200, 실패:500)
$datetime_regist = date("YmdHis");      // 현재날짜 가져오기

// 2. insert쿼리로 데이터를 입력함
$sql = "INSERT INTO tbl_comment_history(datetime_regist, name_register, content) 
        VALUES ({$datetime_regist}, '{$name_register}', '{$content}')";

if ($link->query($sql) === TRUE) {
    $code = 200;
    echo $code;
} else {
    echo $sql . "<br>" . $link->error;
    $code = 500;
}


// 3. DB close
$link->close();
