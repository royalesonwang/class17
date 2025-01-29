<!--<html>
<head>
<meta charset="utf-8">
<title>菜鸟教程(runoob.com)</title>
</head>
<body>
  <form method="post" action="upload_file.php" enctype="multipart/form-data">
       <input name='uploads[]' type="file" multiple>
       <input type="submit" name="uploadpic" value="上传">
  </form>

</body>
</html>
-->
<?php 
    session_start();
    if(empty($_SESSION['user'])){
    header( "Location:../login.php?error=3" );
    exit();
}else{
?>
<html>
<head><title>照片上传</title>
<link rel="stylesheet" href="../css/webstyle.css">
    </head>
<body>

<form action="upload_file.php" method="post" enctype="multipart/form-data">
    <h1>照片上传<br /></h1>
    <p>注意：考虑到服务器内存问题，请尽量不上传重复的照片。上传之前请先整理照片。大于2M，尺寸大于6000×4000的照片会进行压缩，请知悉。</p>
    <select name="type">
        <option value="hz">合照</option>
    <option value="s100">4×100</option>
    <option value="s400">4×400</option>
        <option value="nz400">男子400m和1500m</option>
        <option value="tg">男/女子跳高和跳远</option>
        <option value="flt">翻♂轮胎</option>
        <option value="hd">班级/教工活动</option>
        <option value="dby">班级大本营日常</option>
        <option value="tw">摊位</option>
        <option value="cosplay">cosplay</option>
        <option value="qt">其他</option>    
    </select><br><br>
<input type="file" name="pictures[]" multiple><br /><br/>
<input type="submit" name="upload" value="Send" /><Br><br>
    <a href="../user.php">返回用户中心</a>
    </form>
</body>
</html>
<?php
     }
?>
