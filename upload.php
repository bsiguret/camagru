<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<form enctype="multipart/form-data" action="controller/upload.php" method="POST">
		Choose a file to upload: <input name="uploadedfile" type="file" /><br />
		<input type="submit" value="Upload File" />
	</form>
	<img id="upload" src=""></img>
</body>
<script>
	// var canvas = document.getElementById("myFile");

	// function yolo () {
	// 	canvas.getContext("2d").drawImage(image, 0, 0, image.width, image.height, 0, 0, 640, 480);
	// 	var data64Img = canvas.toDataURL();
	// 	console.log(data64Img);
	// }
</script>
</html>