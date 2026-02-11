<?php
require "common/dbconn.php";
session_start();

$room=$_POST["room"];
$checkin  = $_POST["checkin"];
$checkout = $_POST["checkout"];
$name     = $_POST["name"];
$email    = $_POST["email"];
$phone    = $_POST["phone"];
$m_count  = $_POST["m_count"]; 
$days     = $_POST["days"];
$total    = $_POST["total"];
$id       = $_SESSION["user_id"];

// 유효성 검사 (날짜 부분 수정)
if($checkin == "" || $checkout == "") {
    echo "<script>alert('날짜 필수'); history.back();</script>";
    exit();
}
    if($name == ""){
        echo "<script>
        alert('이름을 입력해주세요.');
        history.back();
        </script>";
        exit();
    }
    if($email == ""){
        echo "<script>
        alert('이메일을 입력해주세요.');
        history.back();
        </script>";
        exit();
    }
    if($phone == ""){
        echo "<script>
        alert('연락처를 입력해주세요.');
        history.back();
        </script>";
        exit();
    }
    if($m_count == ""){
        echo "<script>
        alert('숙박인원을 입력해주세요.');
        history.back();
        </script>";
        exit();
    }

// SQL문 수정 (문자열 변수에 따옴표 추가)
$strSQL = "INSERT INTO reservation (r_no, id, m_name, check_in, check_out, stay_days, m_count, total_price, created_at) 
           VALUES ('$room', '$id', '$name', '$checkin', '$checkout', $days, '$m_count', '$total', NOW())";

if(mysqli_query($conn, $strSQL)) {
    echo "<script>alert('예약이 완료되었습니다.'); location.href='index.php';</script>";
} else {
    echo "에러 발생: " . mysqli_error($conn); // 에러 확인용
}
?>