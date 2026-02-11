<?php
require __DIR__ . "/common/dbconn.php";

$pageTitle = "객실 리스트";
include __DIR__ . "/common/head.php";

// 1. 호수(r_name) 순서대로 데이터를 가져옵니다 (101호, 102호...)
$strSQL = "SELECT * FROM room ORDER BY r_no ASC";
$rs = mysqli_query($conn, $strSQL);
?>

<table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
    <tr>
        <th colspan="4" style="padding:15px;"><font style="font-size:150%;">객실 리스트</font></th>
    </tr>

    <?php
    // 2. while문을 사용하여 모든 객실 정보를 반복 출력
    while ($rs_arr = mysqli_fetch_array($rs)) {
        $r_no = $rs_arr["r_no"];      // 예: 101호
        $type   = $rs_arr["r_name"];      // 예: 싱글룸 (이미지 파일명과 일치해야 함)
        $max    = $rs_arr["max_people"];  // 예: 1
        $price  = $rs_arr["r_price"];     // 예: 50000
    

        // 3. 이미지 경로 설정
        // 파일 위치: /var/www/html/member/common/싱글룸.png
        // 현재 페이지: /var/www/html/member/roomlist.php 이므로 상대경로는 common/파일명
        $image_name = $type . ".png"; 
        $image_path = "common/" . $image_name;
    ?>

    <tr>
        
        <!-- 호수 출력 -->
        <th width="100" align="center">
            <b style="font-size:1.2em;"><?php echo $r_no; ?>호</b>
        </th>


        <!-- 사진 출력 -->
        <td width="200" align="center" style="padding:10px;">
            <img src="<?php echo $image_path; ?>" width="180" alt="<?php echo $type; ?>" onerror="this.src='common/noimage.png';">
        </td>
        
        
        <!-- 레이블 열 -->
        <td width="120" style="padding-left:10px; background-color:#f8f8f8;">
            <p>타입</p>
            <p>숙박인원</p>
            <p>1박 금액</p>
        </td>
        
        <!-- 실제 데이터 열 -->
        <td style="padding-left:10px;">
            <p><?php echo $type; ?></p>
            <p><?php echo $max; ?>명</p>
            <p><?php echo number_format($price); ?>원</p>
        </td>
    </tr>

    <?php
    } // while문 끝
    ?>
</table>

