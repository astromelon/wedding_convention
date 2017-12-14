<?php
/**
 * Created by PhpStorm.
 * User: astromelon
 * Date: 2016-12-10
 * Time: 오후 7:48
 */

include "getlist.php";


class mysqlDBquery
{
    // 축하글 테이블정보 가져오기
    function getCommentHistory()
    {
        $dbcont = new mysqlDBcontrolor();

        // 쿼리 생성
        $sql = "SELECT * FROM TBL_COMMENT_HISTORY ORDER BY seqNo";

        $returnData = $dbcont->getList($sql);

        return $returnData;
    }
}