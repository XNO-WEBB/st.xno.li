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
	<div class="train-icon-container">
		<img src="<?php print baseurl("assets/img/train-icon.png"); ?>">
	</div>
		<div class="selectblock">
			<div class="title">URSPRUNG</div>
			<input type="text" placeholder="Lund C...">
		</div>
		<div class="middleblock">
			<img src="<?php print baseurl("assets/img/train-icon.png"); ?>">
		</div>
		<div class="selectblock">
			<div class="title">DESTINATION</div>
			<input type="text" placeholder="Helsingborg C...">
		</div>
		<div class="buttonblock">
			<a href="" class="button">
				SNABB SÖK
			</a>
		</div>
	</div>
</div>

<?php print $globalPage['partials']['bottom']; ?>
</body>
</html> 