<?php

/**
 * Created by PhpStorm.
 * User: astromelon
 * Date: 2016-12-11
 * Time: 오후 2:20
 */
class ClassDB_Hawk5_Mysql
{
    // PRIVATE 변수
    VAR $CONN;               // DB 커넥션 변수
    VAR $ERR_QUERY;     // 에러가 발생한 쿼리
    VAR $ERR_MSG;        // 에러 메세지
    VAR $RESULT;           // 쿼리 결과
    VAR $REC_COUNT;    // 레코드 합계
    VAR $ROW;               // 레코드 결과 FETCH
    VAR $ROWNUM;        // 현재 레코드 번호

    //클래스 생성자..
    //클래스를 생성하면.. 자동으로 실행된다..
    function ClassDB_Hawk5_Mysql()
    {
        $DB_HOST = "localhost";
        $DB_USER = "hawk5";
        $DB_PWD = "hawk5";
        $DB_NAME = "DB_hawk5";
        $this->CONN = mysqli_connect($DB_HOST, $DB_USER, $DB_PWD) or die("디비연결 실패지롱!");
        mysqli_connect($DB_NAME, $this->CONN) or die("디비명 똑바로 입력해랑");
    }

    // 쿼리문 실행
    function Execute($query)
    {
        $this->ERR_MSG = "";
        if (!$this->RESULT = mysql_query($query)) {
            $this->ERR_QUERY = $query;
            $this->ERR_MSG = mysql_error();
            return false;
        } else {
            $this->REC_COUNT = mysql_num_rows($this->RESULT);
            $this->ROW = mysql_fetch_bject($this->RESULT);
            $this->ROWNUM = 0;
        }
    }

    // RecordCount
    function RecordCount()
    {
        return $this->REC_COUNT;
    }

    // 레코드 처음
    function MoveFirst()
    {
        mysql_data_seek($this->RESULT, 0);
        $this->ROW = mysql_fetcht_assoct($this->RESULT);
    }

    // 레코드 마지막
    function MoveLast()
    {
        mysql_data_seek($this->RESULT, $this->REC_COUNT - 1);
        $this->ROW = mysql_fetcht_assoct($this->RESULT);
    }

    // 다음 레코드
    function MoveNext()
    {
        $this->ROWNUM = $this->ROWNUM + 1;
        if ($this->ROWNUM < $this->REC_COUNT) {
            mysql_data_seek($this->RESULT, $this->ROWNUM);
            $this->ROW = mysql_fetcht_assoct($this->RESULT);
            return true;
        } else {
            return false;
        }
    }

    // 이전 레코드
    function MovePrev()
    {
        $this->ROWNUM = $this->ROWNUM - 1;
        if ($this->ROWNUM >= 0) {
            mysql_data_seek($this->RESULT, $this->ROWNUM);
            $this->ROW = mysql_fetcht_assoct($this->RESULT);
            return true;
        } else {
            return false;
        }
    }

    // 필드값 가져오기
    function Field($field_name)
    {
        return $this->ROW[$field_name];
    }

    // 데이터베이스 접속 종료
    function Close()
    {
        mysql_close($this->CONN);
    }

    //에러메서지를 보여준다
    function ShowError()
    {
        if (strlen($this->ERR_MSG) > 0) {
            $msg = "<h2 align=\"center\">SQL ERROR!</h2>";
            $msg .= "<table border=0>";
            $msg .= "<tr><td bgcolor=\"green\">";
            $msg .= "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\"width=\"600\" height=\"88\">";
            $msg .= "<tr><th height=\"16\"><font color=\"#FFFFFF\">실행된 SQL</font></th></tr>";
            $msg .= "<tr><td bgcolor=\"white\" height=\"16\" align=\"center\">" . $this->QUERY . "</td></tr>";
            $msg .= "<tr<th height=\"16\"><font color=\"#FFFFFF\">Error 내용</font></th></tr>";
            $msg .= "<tr><td bgcolor=\"white\" height=\"28\" align=\"center\">" . $this->ERR_MSG . "</td></tr>";
            $msg .= "</table>";
            $msg .= "</td>";
            $msg .= "</tr>";
            $msg .= "</table>";
            echo $msg;
        }
    }
}