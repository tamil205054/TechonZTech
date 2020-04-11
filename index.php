<?php
// make the database connection
$con=mysqli_connect("localhost","root","","share")or die("Error");
// init the id for play the next video concept
$id=-1;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>You Tube Video</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top:5%">
		<div class="text-center h2 text-success">Dynamic youtube Video Play</div>

	<div class="row" >
		<div class="col-md-5">
			<div class="list-group">
				<?php
					$src="https://www.youtube.com/embed/5NNvx_9KTTU";//init the $src variable to store the embed youtube src
					$query="SELECT * FROM `youtube` order by `id` asc";
					$result=mysqli_query($con,$query);
					if(mysqli_num_rows($result)>0)
					{
						while($row=mysqli_fetch_array($result))
						{
							if($id==$row['id'])
							{
								$src=$row['src'];
								?>
			<a href="index.php?id=<?php echo $row['id'];?>" class="list-group-item list-group-item-action active"><?php echo $row['title']?></a>
								<?php
							}
							else
								{
								?>
			<a href="index.php?id=<?php echo $row['id'];?>" class="list-group-item list-group-item-action "><?php echo $row['title']?></a>
								<?php
							}
						}
					}
				?>
			</div>
		</div>

			<div class="col-md-7">
				  <div class="embed-responsive embed-responsive-16by9">
<iframe width="560" height="315" src="<?php echo $src?>?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  					</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
