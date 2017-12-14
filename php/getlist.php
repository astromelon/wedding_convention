<?php
/**
 * Created by PhpStorm.
 * User: astromelon
 * Date: 2016-12-11
 * Time: 오후 4:35
 */

include 'db_connetion.php';

$sqlquery = "SELECT * FROM tbl_comment_history ORDER BY seqNo";  // 쿼리

// 1. 데이터베이스에서 데이터를 가져옴
if ($result = mysqli_query($link, $sqlquery, MYSQLI_USE_RESULT)) {
    // 2. 데이터베이스로부터 반환된 데이터를 객체 형태로 가공함
    $o = array();
    while ($row = mysqli_fetch_object($result)) {
        $t = new stdClass();
        $t->seqNo = $row->seqNo;                        // 축하글seqNo
        $t->datetime_regist = $row->datetime_regist;    // 등록일자
        $t->name_register = $row->name_register;        // 등록자 이름
        $t->content = $row->content;                    // 등록글내용
        $o[] = $t;
        unset($t);
    }
} else {
    $o = array(0 => 'empty');
}


// 3. 최종 결과 데이터를 JSON 스트링으로 반환
//echo json_encode($o);
echo json_encode($o, JSON_UNESCAPED_UNICODE);

// DB Close
$link->close();


