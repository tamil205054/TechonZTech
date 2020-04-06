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
			$target='upload/'.$_FILES['image']['name'];
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
	$out=array();
	$out['msg']=$msg;
	$out['image']=$path;
	echo json_encode($out);
}
?>




