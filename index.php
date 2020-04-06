<?php
// database connection
$con=mysqli_connect("localhost","root","","share")or die("Error");
$msg="";//for display message after file upload
$path="";//its used for display the image after upload the image;
if(isset($_POST['sub']))
{
	if(is_uploaded_file($_FILES['image']['tmp_name']))
	{
		$exten=pathinfo($_FILES['image']['name']);
		$arr_ex=array('jpg','jpeg','png','JPG','PNG','JPEG');
		if(in_array($exten['extension'],$arr_ex))
		{
			$source=$_FILES['image']['tmp_name'];
			$target=$_FILES['image']['name'];
			if(move_uploaded_file($source,$target))
			{
				$path=$target;
				$query="INSERT INTO `upload`(`image`) values ('".$path."')";
				if(mysqli_query($con,$query))
				{
		$msg='<span class="text-success">Image Upload</span>';

				}
				else
				{
		$msg='<span class="text-danger">Somthing Wrong</span>';

				}
			}
		}
     		else
		{
		$msg='<span class="text-danger">Select only jpg,jpeg,png file</span>';
		}
	}
	else
	{
		$msg='<span class="text-danger">Select the Image</span>';
	}	
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
			<h3 class="text-center">Image Upload</h3>
			<div class="card" style="padding: 30px">
		<form method="post" action="index.php" id="form" enctype="multipart/form-data">
					<div class="form-group">
						<label>Image:</label>
						<input type="file" name="image" id="image" class="form-control">
						<?php echo $msg?>
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
