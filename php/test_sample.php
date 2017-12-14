<?php
/**
 * Created by PhpStorm.
 * User: astromelon
 * Date: 2016-12-11
 * Time: 오후 2:21
 */

include "./ClassDB_Hawk5_Mysql.php";
// 클래스 생성,
$db = new ClassDB_Hawk5_Mysql();
// 쿼리 실행
$query = "SELECT * FROM TB_Member ORDER ";

//실행후 오류가 있으면 출혁하고 없으면 총결과 갯수를 출력한다
if($db->Execute($query))
{
    // 레코드 총합
    echo "레코드 합계 : ";
    echo $db->RecordCount();
}
else
{
    // 오류가 있다면 출력
    $db->ShowError();
    exit;
}
// 레코드를 가져와서 출력
do {
    echo $db->Field("UserId");
    echo "<br>";
} while($db->MoveNext());
$db->Close();