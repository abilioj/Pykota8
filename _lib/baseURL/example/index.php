<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pegar a url principal php</title>
</head>
<body>
	<?php
	
		include '../src/baseURI.php';

		$uri = new URI();
		echo $uri->base();
	?>
</body>
</html>