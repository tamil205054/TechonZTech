<?php
$con=mysqli_connect("localhost","root","","share")or die("Error");
$msg="";
$path="";
	if(isset($_POST['sub']))
	{
		if(is_uploaded_file($_FILES['image']['tmp_name']))
		{
			$file=$_FILES['image']['name'];
			$ex=pathinfo($_FILES['image']['name']);
			$ex=strtolower($ex['extension']);
			$extension=array('jpg','jpeg','png');
			$location=$file;
			if(in_array($ex,$extension))
			{
				if(compressImage($_FILES['image']['tmp_name'],$location,20))
				{
					$query="INSERT INTO `upload` (`image`) values ('".$location."')";
					if(mysqli_query($con,$query))
					{
						$msg="Image compree and Upload";
						$path=$location;
					}
					else
					{
						$msg="Image Not Upload";
					}
				}
				else
				{
					$msg="Image Not Compressed";
				}
			}
			else
			{
				$msg="Select only jpg,png,jpeg";
			}
		}
		else
		{
			$msg="Select the image";
		}
	}
	function compressImage($source,$destination,$quality)
	{
		$info=getimagesize($source);
		if($info['mime']=='image/jpeg')
		{
			$i=imagecreatefromjpeg($source);
			if(imagejpeg($i,$destination,$quality))
			{
				return true;
			}
		}
		else if($info['mime']=='image/png')
		{
			$i=imagecreatefrompng($source);
			if(imagepng($i,$destination,$quality))
			{
				return true;
			}
		}
		return false;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>File  Upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3" style="margin-top:20px">
			<h3 class="text-center">Image Compress and Upload</h3>
			<div class="card" style="padding: 30px">
		<form method="post" action="index.php" id="form" enctype="multipart/form-data">
					<div class="form-group">
						<label>Image:</label>
						<input type="file" name="image" id="image" class="form-control">
						<span class="text-info"><?php echo $msg;?></span>
					</div>
					<div>
						<input type="submit" name="sub" value="Upload" class="btn btn-success">
					</div>
				</form>
			</div>

		<br>
		<br>
		<?php
		if(!empty($path))
		{
			echo '<img src="'.$path.'" class="img-responsive" width="100%" height="50%"/>';
		}
		?>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
