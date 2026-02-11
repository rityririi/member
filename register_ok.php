<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

require "common/dbconn.php";

    $id=$_POST["user_id"];
    $name=$_POST["name"];
    $pw1=$_POST["user_pw1"];
    $pw2=$_POST["user_pw2"];
    $age=$_POST["age"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $age=$_POST["age"];

    if(!$age) $age=0;

    if(!ctype_alnum($id)){
        echo "<script>
        alert('영문과 숫자만 허용');
        history.back();
        </script>";
        exit();
    }

    if($id == "" || strlen($id) < 4 || strlen($id) > 12 ) {
        echo "<script>
        alert('아이디를 다시 입력');
        history.back();
        </script>";
        exit();
    }
    if($name == "" ){
        echo "<script>
        alert('이름을 다시 입력');
        history.back();
        </script>";
        exit();
    }
    if(preg_match('/^[^a-zA-Z0-9!@#$%^&*()]+$/', $pw1)){
        echo "<script>
        alert('영문과 숫자, 특수기호만 허용');
        history.back();
        </script>";
        exit();
    }
    if($pw1 = "" || strlen($pw1) < 6 || strlen($pw1) >20){
        echo "<script>
        alert('비밀번호를 다시 입력');
        history.back();
        </script>";
        exit();
    }
    if($pw1 != $pw2 || $pw2 == ""){
        echo "<script>
        alert('비밀번호 불일치');
        history.back();
        </script>";
        exit();
    }

    $strSQL = "select u_id from member where u_id = '".$id."';";
    $rs = mysqli_query($conn,$strSQL);
    $rs_arr = mysqli_fetch_array($rs);

    if($rs_arr){
        echo "<script>
        alert('중복 ID, 회원가입 실패.');
        history.back();
        </script>";
    } else {
        $strSQL = "insert into member values (0,'$name','$id','$pw1',$age,'$email',$phone,0,now(),'user')";
        mysqli_query($conn,$strSQL);
        echo "<script>
        alert('회원가입을 축하합니다.');
        location.replace('/member/login.php');
        </script>";
    }
?>