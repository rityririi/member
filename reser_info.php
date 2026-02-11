<?php
require __DIR__ . "/common/dbconn.php";
$pageTitle = "예약확인";
include __DIR__ . "/common/head.php";

$userId = $_SESSION['user_id'] ?? '';
$strSQL = "SELECT * FROM reservation WHERE id='$userId' ORDER BY created_at DESC ";
$rs = mysqli_query($conn, $strSQL);
?>



<table width="700">

                <tr>
                  <th colspan="2"><font style="font-size:150%;">예 약 내 역</font></th>  
                </tr>

<?php

    while ($rs_arr = mysqli_fetch_array($rs)){

    $res_no = $rs_arr["res_no"];
    $room = $rs_arr["r_no"];
    $id = $rs_arr["id"];
    $name = $rs_arr["m_name"];
    $checkin = $rs_arr["check_in"];
    $checkout = $rs_arr["check_out"];
    $days = $rs_arr["stay_days"];
    $count = $rs_arr["m_count"];
    $total = $rs_arr["total_price"];
    $status = $rs_arr["status"];
    $res_date = $rs_arr["created_at"];
?>

                <tr>
                    <th>예약번호</th>
                    <td><?php echo $res_no; ?></td>
                </tr>
                <tr>
                    <th>객실</th>
                    <td><?php echo $room; ?>호</td>
                </tr>
                <tr>
                    <th>체크인</th>
                    <td><?php echo $checkin; ?></td>
                </tr>
                <tr>
                    <th>체크아웃</th>
                    <td><?php echo $checkout; ?></td>
                </tr>
                <tr>
                    <th>숙박일수</th>
                    <td><?php echo $days; ?>일</td>
                </tr>
                <tr>
                    <th>총금액</th>
                    <td><?php echo $total; ?>원</td>
                </tr>
                <tr>
                    <th>투숙객</th>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <th>숙박인원</th>
                    <td><?php echo $count; ?>명</td>
                </tr>
                <tr>
                    <th>예약상태</th>
                    <td><?php echo $status; ?></td>
                </tr>
                <tr>
                    <th>예약일자</th>
                    <td><?php echo $res_date; ?></td>
                </tr>
<?php
}
 if (mysqli_num_rows($rs) == 0) {
        echo "<tr><td colspan='2' align='center' style='padding:50px;'>예약 내역이 없습니다.</td></tr>";
    }
?>

</table>
