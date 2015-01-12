<!doctype html>
<html>
<head>
	<?php print $globalPage['partials']['top']; ?>
	<title>404 Page does not exist</title>
<style>
body {
	padding: 0;
	background-color: #2A2A2A;
}

.middle {
	width: 80px;
	height: 80px;
	background-color: #1E1E1F;
	border-radius: 100%;
	position: fixed;
	top: 50%;
	left: 50%;
	margin-left: -40px;
	margin-top: -40px;
}
.cross1 {
	width: 4px;
	height: 40px;
	background-color: #fff;
	position: absolute;
	top: 20px;
	left: 38px;
	transform: rotate(45deg);
	transition: all 0.3s;
}
.cross2 {
	width: 4px;
	height: 40px;
	background-color: #fff;
	position: absolute;
	top: 20px;
	left: 38px;
	transform: rotate(-45deg);
	transition: all 0.3s;
}
.middle:hover .cross1 {
	transform: rotate(135deg);	
}
.middle:hover .cross2 {
	transform: rotate(45deg);	
}

</style>
</head>
<body>

<a class="middle" href="<?php print baseurl(); ?>">
	<div class="cross1"></div>
	<div class="cross2"></div>
</a>

<?php print $globalPage['partials']['bottom']; ?>
</body>
</html>