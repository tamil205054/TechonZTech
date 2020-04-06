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
					</div>
					<div>
						<input type="submit" name="sub" value="Upload" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
