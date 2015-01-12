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

<?php include basein("ajax/skanetrafiken.php"); ?>

<?php print $globalPage['partials']['bottom']; ?>
</body>
</html> 