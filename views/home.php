<!doctype html>
<html lang="<?php print $globalPage['info']['htmlLanguage']; ?>">
<head>
  <?php print $globalPage['partials']['top']; ?>
  <title><?php print $globalPage['info']['title']; ?></title>
  <meta name="keywords"     content="<?php print $globalPage['info']['tags']; ?>">
  <meta name="description"  content="<?php print $globalPage['info']['desc']; ?>">
  <meta name="author"     	content="<?php print $globalPage['info']['author']; ?>">
</head>
<body>
<?php print $globalPage['partials']['navbar']; ?>

<div class="search-wrapper">
	<div class="search-container">
		<div class="custom-row">
			<div type="text" class="blockleft title">URSPRUNG</div>
			<div class="blockmiddle">
			</div>
			<div type="text" class="blockleft title">DESTINATION</div>
		</div>
		<div class="custom-row">
			<input type="text" class="blockleft" placeholder="Lund C..">
			<div class="blockmiddle">
				<img src="<?php print baseurl("assets/img/train-icon.png"); ?>">
			</div>
			<input type="text" class="blockleft" placeholder="Lund C..">
		</div>
		<div class="custom-row">
			<a href="" class="search-button">
				SNABB SÖK
			</a>
		</div>
	</div>
</div>

<?php print $globalPage['partials']['bottom']; ?>
</body>
</html> 