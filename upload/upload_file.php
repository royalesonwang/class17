<?php
error_reporting( 0 );
include( "../conn.php" );
session_start();
//记录信息
if ( !empty( $_SERVER[ "HTTP_CLIENT_IP" ] ) ) {
        $cip = $_SERVER[ "HTTP_CLIENT_IP" ];
} elseif ( !empty( $_SERVER[ "HTTP_X_FORWARDED_FOR" ] ) ) {
        $cip = $_SERVER[ "HTTP_X_FORWARDED_FOR" ];
}
elseif ( !empty( $_SERVER[ "REMOTE_ADDR" ] ) ) {
        $cip = $_SERVER[ "REMOTE_ADDR" ];
}
else {
        $cip = "Unknown";
}
$i = 0;
$agent = $_SERVER[ 'HTTP_USER_AGENT' ];
$url = "http://www.class17forever.top" . $_SERVER[ 'REQUEST_URI' ];
$time = time();
$sql = "SELECT * FROM people where email='" . $_SESSION[ 'user' ] . "'";
$result = mysqli_query( $conn, $sql );
$rows = mysqli_fetch_array( $result );
$uploader = $rows[ 'nickname' ];
$type = $_POST[ 'type' ];
$keywords = $_POST['keywords'];
$demo = $_POST['demo'];
if ( $_POST[ 'upload' ] == '上传' ) {
        $dest_folder = "temp/";
        if ( !file_exists( $dest_folder ) ) {
                mkdir( $dest_folder );
        }
        foreach ( $_FILES[ "pictures" ][ "error" ] as $key => $error ) {
                if ( $error == UPLOAD_ERR_OK ) {
                        $time = time();
                        $tmp_name = $_FILES[ "pictures" ][ "tmp_name" ][ $key ];
                        $name = $_FILES[ "pictures" ][ "name" ][ $key ];
                        $suffix = strstr( $name, "." );
                        if ( $suffix != ".jpg"
                                and $suffix != ".jpeg"
                                and $suffix != ".png"
                                and $suffix != ".gif"
                                and $suffix != ".JPG"
                                and $suffix != ".PNG"
                                and $suffix != ".JPEG"
                                and $suffix != ".GIF" ) {
                                echo "<script>alert('文件格式不对！');location.href='http://class17forever.top/user/?function=upload';</script>";
                                exit;
                        } else {
                                $a = explode( ".", $_FILES[ "pictures" ][ "name" ][ $key ] );
                                $rename = time() . "_" . mt_rand( 100, 999 ) . "." . $a[ 1 ];
                                $size = $_FILES[ 'pictures' ][ 'size' ][ $key ];
                                $uploadfile = $dest_folder . $rename;
                                move_uploaded_file( $tmp_name, $uploadfile );
                                $i = $i + 1;
                                $res = mysqli_query( $conn, "INSERT INTO img(img,type,size,time,uploader,demo,keywords) VALUES('$rename','$type','$size','$time','$uploader','$demo','$keywords')" );
                                if ( $res ) {
                                        echo $name . "上传成功！<br />";
                                } else {
                                        echo( "上传失败" );
                                        $action = "上传文件-失败";
                                        if ( !empty( $_SESSION[ 'user' ] ) ) {
                                                $user = $_SESSION[ 'user' ];
                                                mysqli_set_charset( $conn, "utf8" );
                                                mysqli_query( $conn, "INSERT INTO log(ip,user,action,time,url,device) values('$cip','$user','$action','$time','$url','$agent')" );
                                        } else {

                                                mysqli_query( $conn, "insert into log(url,action,device,time,ip,user) values('$url','$action','$agent','$time','$cip','未登录')" );

                                        }
                                }
                        }
                }
        }
        exec( 'C:\Users\Administrator\AppData\Local\Programs\Python\Python38\python.exe C:\www\py\PicCompV2.00.5.py',$output, $status );
            $result = mysqli_query($conn,"select * from img where time='$time'");
$date = date("Y-m-d-H-i-s");
      $myfile = fopen("log/$uploader uploaded at $date.txt", "w") or die("Unable to open file!");
    mysqli_set_charset($conn,"utf8");
    $txt = implode("\n",$output);
fwrite($myfile, $txt);
    fclose($myfile);
            $rows = mysqli_fetch_array($result);
/*            while($rows){
                $i=0;
                $img = $rows['img'];
                if(!file_exists("icon/$img")){
                    unlink("temp/$img");
                    mysqli_query($conn,"delete from img where img='$img'"); 
                    $arr[$i]= $img;
                    $i=$i+1;
                }
            }
    if ( $status == "0" ) {
            if($i==0){
                $action = "上传" . $i . "个文件-成功";
                if ( !empty( $_SESSION[ 'user' ] ) ) {
                        $user = $_SESSION[ 'user' ];
                        mysqli_set_charset( $conn, "utf8" );
                        mysqli_query( $conn, "INSERT INTO log(ip,user,action,time,url,device) values('$cip','$user','$action','$time','$url','$agent')" );
                } else {

                        mysqli_query( $conn, "insert into log(url,action,device,time,ip,user) values('$url','$action','$agent','$time','$cip','未登录')" );

                }
                echo "<script>alert('上传成功，且照片压缩成功！');location.href='http://class17forever.top/user/?function=upload';</script>";
            }else{
                echo "<script>alert('有些照片未上传成功！');location.href='http://class17forever.top/user/?function=upload';</script>";
                                $action = "上传文件-未压缩成功";
                if ( !empty( $_SESSION[ 'user' ] ) ) {
                        $user = $_SESSION[ 'user' ];
                        mysqli_set_charset( $conn, "utf8" );
                        mysqli_query( $conn, "INSERT INTO log(ip,user,action,time,url,device) values('$cip','$user','$action','$time','$url','$agent')" );
                } else {

                        mysqli_query( $conn, "insert into log(url,action,device,time,ip,user) values('$url','$action','$agent','$time','$cip','未登录')" );

                }
            }
        } else {
                $action = "上传文件-压缩失败";
                if ( !empty( $_SESSION[ 'user' ] ) ) {
                        $user = $_SESSION[ 'user' ];
                        mysqli_set_charset( $conn, "utf8" );
                        mysqli_query( $conn, "INSERT INTO log(ip,user,action,time,url,device) values('$cip','$user','$action','$time','$url','$agent')" );
                } else {

                        mysqli_query( $conn, "insert into log(url,action,device,time,ip,user) values('$url','$action','$agent','$time','$cip','未登录')" );

                }
                rmdir( "../upload/temp/" );
                echo "<script>alert('压缩失败！');location.href='http://class17forever.top/user/?function=upload';</script>";

        } */
    if ( $status == "0" ) {
        $action = "上传" . $i . "个文件-成功";
                if ( !empty( $_SESSION[ 'user' ] ) ) {
                        $user = $_SESSION[ 'user' ];
                        mysqli_set_charset( $conn, "utf8" );
                        mysqli_query( $conn, "INSERT INTO log(ip,user,action,time,url,device) values('$cip','$user','$action','$time','$url','$agent')" );
                } else {

                        mysqli_query( $conn, "insert into log(url,action,device,time,ip,user) values('$url','$action','$agent','$time','$cip','未登录')" );

                }
                echo "<script>alert('上传成功，且照片压缩成功！');location.href='http://class17forever.top/user/?function=upload';</script>";
        
    }else{
                        $action = "上传文件-压缩失败";
                if ( !empty( $_SESSION[ 'user' ] ) ) {
                        $user = $_SESSION[ 'user' ];
                        mysqli_set_charset( $conn, "utf8" );
                        mysqli_query( $conn, "INSERT INTO log(ip,user,action,time,url,device) values('$cip','$user','$action','$time','$url','$agent')" );
                } else {

                        mysqli_query( $conn, "insert into log(url,action,device,time,ip,user) values('$url','$action','$agent','$time','$cip','未登录')" );

                }
                rmdir( "../upload/temp/" );
                echo "<script>alert('压缩失败！');location.href='http://class17forever.top/user/?function=upload';</script>";
    }
}
?>
<html>
<head>
<!--<meta http-equiv="refresh" content="3;url=http://47.114.156.37/user/?function=upload" />-->
<title>上传中...</title>
</head>
<body>
</body>
</html>