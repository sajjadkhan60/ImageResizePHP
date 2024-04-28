<?php
	$newimage = "";
if(isset($_POST['submit'])){
	//header('Content-Type:image/jpeg');
	//$file="sample.jpg";

	if($_FILES['file']['type']=='image/png' || $_FILES['file']['type']=='image/jpeg' || $_FILES['file']['type']=='image/gif')
	{
		$file=$_FILES['file']['tmp_name'];
		list($width,$height)=getimagesize($file);
		if($width >= 5000)
		{
			$nwidth=$width/5;
			$nheight=$height/5;
		}
		else if($width >= 4000)
		{
			$nwidth=$width/4;
			$nheight=$height/4;
		}
		else if($width >= 3000)
		{
			$nwidth=$width/3;
			$nheight=$height/3;
		}
		else if($width >= 1500)
		{
			$nwidth=$width/2.5;
			$nheight=$height/2.5;
		}
		else if($width >= 1000)
		{
			$nwidth=$width/2;
			$nheight=$height/2;
		}
		else if($width >= 500)
		{
			$nwidth=$width/1.3;
			$nheight=$height/1.3;
		}
		else 
		{
			$nwidth=$width/1;
			$nheight=$height/1;
		}
		$newimage=imagecreatetruecolor($nwidth,$nheight);
		if($_FILES['file']['type']=='image/jpeg'){
			$source=imagecreatefromjpeg($file);
			imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
			$file_name=time().'.jpg';
			imagejpeg($newimage,'upload/'.$file_name);
		}elseif($_FILES['file']['type']=='image/png'){
			$source=imagecreatefrompng($file);
			imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
			$file_name=time().'.png';
			imagepng($newimage,'upload/'.$file_name);
		}elseif($_FILES['file']['type']=='image/gif'){
			$source=imagecreatefromgif($file);
			imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
			$file_name=time().'.gif';
			imagegif($newimage,'upload/'.$file_name);
		}
	}
	else
	{
		echo "Please select only jpg, png and gif image";
	}
}
?>
<center>
<form method="post" enctype="multipart/form-data">
	<input type="file" name="file" required>
	<input type="submit" name="submit"/>
</form>
<?php
if($newimage)
{
	echo '<img src="upload/'.$file_name.'" style="width:400px">';
	echo '<h1 align="center">'.$file_name.'</h1>';
}
?>
</center>
