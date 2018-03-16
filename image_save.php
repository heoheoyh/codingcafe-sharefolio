<?php
include_once ('config.php');
header("Content-Type: text/html; charset= UTF-8 ");

//ÇöÀç ¾÷·Îµå »óÅÂÀÎÁö¸¦ Ã¼Å©
if ($_POST['mode'] == 'upload') {

	//1. ¾÷·Îµå ÆÄÀÏ Á¸Àç¿©ºÎ È®ÀÎ
	if (!isset($_FILES['upload'])) {
		exit("¾÷·Îµå ÆÄÀÏ Á¸ÀçÇÏÁö ¾ÊÀ½");
	}//if

	//2. ¾÷·Îµå ¿À·ù¿©ºÎ È®ÀÎ
	if ($_FILES['upload']['error'] > 0) {
		switch ($_FILES['upload']['error']) {
			case 1 :
				exit("php.ini ÆÄÀÏÀÇ upload_max_filesize ¼³Á¤°ªÀ» ÃÊ°úÇÔ(¾÷·Îµå ÃÖ´ë¿ë·® ÃÊ°ú)");
			case 2 :
				exit("Form¿¡¼­ ¼³Á¤µÈ MAX_FILE_SIZE ¼³Á¤°ªÀ» ÃÊ°úÇÔ(¾÷·Îµå ÃÖ´ë¿ë·® ÃÊ°ú)");
			case 3 :
				exit("ÆÄÀÏ ÀÏºÎ¸¸ ¾÷·Îµå µÊ");
			case 4 :
				exit("¾÷·ÎµåµÈ ÆÄÀÏÀÌ ¾øÀ½");
			case 6 :
				exit("»ç¿ë°¡´ÉÇÑ ÀÓ½ÃÆú´õ°¡ ¾øÀ½");
			case 7 :
				exit("µð½ºÅ©¿¡ ÀúÀåÇÒ¼ö ¾øÀ½");
			case 8 :
				exit("ÆÄÀÏ ¾÷·Îµå°¡ ÁßÁöµÊ");
			default :
				exit("½Ã½ºÅÛ ¿À·ù°¡ ¹ß»ý");
		} // switch
	}//if

	//3. ¾÷·Îµå Á¦ÇÑ¿ë·® Ã¼Å©(¼­¹öÃø¿¡¼­ 5M·Î Á¦ÇÑ)
	if ($_FILES['upload']['size'] > 5242880) {
		exit("¾÷·Îµå ÃÖ´ë¿ë·® ÃÊ°ú");
	}//if

	//4. ¾÷·Îµå Çã¿ë È®ÀåÀÚ Ã¼Å©(º¸ÆíÀûÀÎ jpg,jpeg,gif,png,bmp È®ÀåÀÚ¸¸ ÇÊÅÍ¸µ)
	$ableExt = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
	$path = pathinfo($_FILES['upload']['name']);
	$ext = strtolower($path['extension']);

	if (!in_array($ext, $ableExt)) {
		exit("Çã¿ëµÇÁö ¾Ê´Â È®ÀåÀÚÀÔ´Ï´Ù.");
	}//if

	//5. MIME¸¦ ÅëÇØ ÀÌ¹ÌÁöÆÄÀÏ¸¸ Çã¿ë(2Â÷ È®ÀÎ)
	$ableImage = array('image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png', 'image/gif', 'image/bmp', 'image/pjpeg');
	if (!in_array($_FILES['upload']['type'], $ableImage)) {
		exit("ÁöÁ¤µÈ ÀÌ¹ÌÁö¸¸ Çã¿ëµË´Ï´Ù.");
	}//if

	//6. DB¿¡ ÀúÀåÇÒ ÀÌ¹ÌÁö Á¤º¸ °¡Á®¿À±â(width,height °ª È°¿ë)
	$img_size = getimagesize($_FILES['upload']['tmp_name']);

	//DB¿¬°á
	$db = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
	if (mysqli_connect_error()) {
		exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}//if

	//do~while: »õ·Î¸¸µç ÆÄÀÏ¸íÀÌ Áßº¹ÀÏ°æ¿ì ¹Ýº¹ÇÏ±â À§ÇÑ ·çÆ¾
	do {

		//6. »õ·Î¿î ÆÄÀÏ¸í »ý¼º(¸¶ÀÌÅ©·ÎÅ¸ÀÓ°ú È®ÀåÀÚ ÀÌ¿ë)
		$time = explode(' ', microtime());
		$fileName = $time[1] . substr($time[0], 2, 6) . '_' . strtoupper($ext);

		//Áß¿ä ÀÌ¹ÌÁöÀÇ °æ¿ì À¥·çÆ®(www) ¹Û¿¡ À§Ä¡ÇÒ °ÍÀ» ±ÇÀå(¿¹Á¦ ÆíÀÇ»ó ¾Æ·¡¿Í °°ÀÌ ¼³Á¤)
		$filePath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

		//7. »ý¼ºÇÑ ÆÄÀÏ¸íÀÌ DB³»¿¡ Á¸ÀçÇÏ´ÂÁö Ã¼Å©
		$query = sprintf("SELECT * FROM file_list WHERE db_filename = '%s'", $fileName);
		$result = $db -> query($query);

		//»ý¼ºÇÑ ÆÄÀÏ¸íÀÌ Áßº¹ÇÏ´Â °æ¿ì »õ·Î »ý¼ºÇØ¼­ Ã¼Å©¸¦ ¹Ýº¹(µ¿½ÃÀúÀå¼ö°¡ ´ë·®ÀÌ ¾Æ´Ñ°æ¿ì Áßº¹°¡´É Èñ¹Ú)
	} while($result->num_rows > 0);

	//db¿¡ ÀúÀåÇÒ Á¤º¸ °¡Á®¿È
	$upload_filename = $db -> real_escape_string($_FILES['upload']['name']);
	$file_size = $_FILES['upload']['size'];
	$file_type = $_FILES['upload']['type'];
	

	//¿ÀÅäÄ¿¹Ô ÇØÁ¦
	$db -> autocommit(false);

	//8. db¿¡ ¾÷·Îµå ÆÄÀÏ ¹× »õ·Î »ý¼ºµÈ ÆÄÀÏÁ¤º¸µîÀ» ÀúÀå
	$query = sprintf("INSERT INTO file_list
		(upload_filename,db_filename,file_path,file_size,file_type,demo,myurl,name) 
		VALUES ('%s','%s','%s',%d,'%s', '$_POST[demo]', '$_POST[myurl]', '$_POST[name]')", $upload_filename, $fileName, $filePath, $file_size, $file_type);

	$db -> query($query);

	//DB¿¡ ÆÄÀÏ³»¿ë ÀúÀå ¼º°ø½Ã
	if ($db -> affected_rows > 0) {

		//9. ¾÷·Îµå ÆÄÀÏÀ» »õ·Î ¸¸µç ÆÄÀÏ¸íÀ¸·Î º¯°æ ¹× ÀÌµ¿
		if (move_uploaded_file($_FILES['upload']['tmp_name'], $filePath . $fileName)) {

			//10. ¼º°ø½Ã dbÀúÀå ³»¿ëÀ» Àû¿ë(Ä¿¹Ô)
			$db -> commit();
			echo "<meta http-equiv='refresh' content='0; url=sharefolio.php'>"; 
             echo "<script>alert('suceess upload!!');</script>";
		} else {
			//½ÇÆÐ½Ã db¿¡ ÀúÀåÇß´ø ³»¿ë Ãë¼Ò¸¦ À§ÇÑ ·Ñ¹é
			$db -> rollback();
		  echo "<meta http-equiv='refresh' content='0; url=sharefolio.php'>"; 
             echo "<script>alert('fail upload!!');</script>";
		}//if
	}//if
}//if
?>