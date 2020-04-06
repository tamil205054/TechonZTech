<?php
$con=mysqli_connect("localhost","root","","share")or die("Error");
if(isset($_POST['type']))
{
	if($_POST['type']=="postDate")
	{
		$query="INSERT INTO `hide_date`(`id`, `start`, `end`) VALUES (null,'".$_POST['start']."','".$_POST['end']."');";
		$result=mysqli_query($con,$query);
		if($result)
		{
			echo "success";
		}
	}
	if($_POST['type']=="getDate")
	{
		$query="SELECT distinct `start` ,`end` from `hide_date`";
		$result=mysqli_query($con,$query);
		$output=array();
		if(mysqli_num_rows($result)>0)
		{
			while ($row=mysqli_fetch_array($result)) 
			{
				$start=strtotime($row['start']);
				$end=strtotime($row['end']);
				for ($i=$start;$i<=$end; $i+=86400) 
				{  
					$d=date('j-n-Y',$i);
					$output[]=$d;
				}
			}
		}
	echo  json_encode($output);
	}
}
?>