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

<div class="journey-container">
	<div class="col-md-12">
		<div class="row headings">
			<div class="col-xs-1 text-center">AVG</div>
			<div class="col-xs-1 text-center">ANK</div>
			<div class="col-xs-2 text-center">RESTID</div>
			<div class="col-xs-1 text-center">BYTEN</div>
			<div class="col-xs-2 text-center">TRAFIKSLAG</div>
			<div class="col-xs-2 text-center">PRIS</div>
			<div class="col-xs-3 text-center">FÖRHINDER</div>
		</div>
		<?php
		$getTree = $globalData['url_data'];
		$request = "http://" . $_SERVER['SERVER_NAME'] . baseurl("ajax/journey_search_view.php") . "?fromPoint=" . $getTree[1] . "&fromId=" . $getTree[2] . "&toPoint=" . $getTree[3] . "&toId=" . $getTree[4] ;
		print $request;
		 ?>
		<?php print file_get_contents($request); ?>
	</div>
</div>

<?php print $globalPage['partials']['bottom']; ?>
</body>
</html> 