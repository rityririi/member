<?php
require __DIR__ . "/common/dbconn.php";
$pageTitle = "예약";
include __DIR__ . "/common/head.php";

// 세션 변수 사용 시 따옴표 짝 맞추기
$strSQL = "SELECT * FROM member WHERE id='{$_SESSION["user_id"]}'";
$rs = mysqli_query($conn, $strSQL);
$rs_arr = mysqli_fetch_array($rs);

// 객실 가격 정보 가져오기 (쿼리문 따옴표 닫기 확인)
$roomSQL = "SELECT r_no, r_price FROM room"; 
$roomRS = mysqli_query($conn, $roomSQL);
$roomPrices = [];
while($row = mysqli_fetch_array($roomRS)) {
    $roomPrices[$row['r_no']] = $row['r_price'];
}
?>

<body>
    <div id="reservation_contents" class="contents"> <form name="rform" method="post" action="reser_ok.php">
            <table width="700">
                <tr>
                  <th colspan="2"><font style="font-size:150%;">예 약</font></th>  
                </tr>
                <tr>
                    <th>객실선택</th>
                    <td>
                        <select name="room" onchange="calc()">
                            <option value="">선택하세요</option>
                            <option value="101">101호 싱글</option>
                            <option value="102">102호 싱글</option>
                            <option value="103">103호 더블</option>
                            <option value="201">201호 싱글</option>
                            <option value="202">202호 더블</option>
                            <option value="203">203호 더블</option>
                            <option value="301">301호 디럭스</option>
                            <option value="302">302호 디럭스</option>
                            <option value="303">303호 스위트</option>
                            <option value="401">401호 패밀리</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>체크인 날짜</th>
                    <td><input type="date" name="checkin" onchange="calc()"></td>
                </tr>
                <tr>
                    <th>체크아웃 날짜</th>
                    <td><input type="date" name="checkout" onchange="calc()"></td>
                </tr>
                <tr>
                    <th>투숙객 이름</th>
                    <td><input type="text" name="name" value="<?=$rs_arr["name"]?>"></td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td><input type="text" name="email" value="<?=$rs_arr["email"]?>"></td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td><input type="text" name="phone" value="<?=$rs_arr["phone"]?>"></td>
                </tr>
                                <tr>
                    <th>숙박인원</th>
                    <td><input type="num" name="m_count" value="1"> 명</td>
                </tr>
                <tr>
                    <th>숙박일수</th>
                    <td><input type="text" name="days" readonly> 일</td>
                </tr>
                <tr>
                    <th>총 금액</th>
                    <td><input type="text" name="total" readonly> 원</td>
                </tr>
            </table>
            
            <p><input type="button" value="예약" onclick="ck()"></p>
        </form>
    </div>

    <script>
    // PHP 데이터를 JS 객체로 변환
    var roomPrices = <?php echo json_encode($roomPrices); ?>;
    var rf = document.rform;

    function calc() {
        var inDate = new Date(rf.checkin.value);
        var outDate = new Date(rf.checkout.value);

        if (rf.checkin.value && rf.checkout.value && rf.room.value) {
            var diff = outDate - inDate;
            var days = diff / (1000 * 60 * 60 * 24);

            if (days > 0) {
                rf.days.value = days;
                var selectedRoom = rf.room.value;
                var unitPrice = roomPrices[selectedRoom] || 0;
                rf.total.value = days * unitPrice;
            } else {
                rf.days.value = 0;
                rf.total.value = 0;
            }
        }
    }

    function ck() {
        if(!rf.room.value) { alert('객실 선택 필수'); return false; }
        if(!rf.checkin.value) { alert('체크인 날짜 필수'); return false; }
        if(!rf.checkout.value) { alert('체크아웃 날짜 필수'); return false; }
        // ... 나머지 유효성 검사 동일
        rf.submit(); // 검사 통과 시 전송
    }
    </script>
</body>