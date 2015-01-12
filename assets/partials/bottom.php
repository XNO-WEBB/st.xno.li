<input id="baseurl" type="hidden" data-baseurl="<?php print baseurl(""); ?>">
<script src="<?php print baseurl("assets/js/jquery.min.js"); ?>"></script>
<script src="<?php print baseurl("assets/js/jquery-ui.min.js"); ?>"></script>
<script src="<?php print baseurl("assets/js/bootstrap.min.js"); ?>"></script>
<script src="<?php print baseurl("assets/js/angular.min.js"); ?>"></script>
<script src="<?php print baseurl("assets/js/main.js"); ?>"></script>

<?php
$extras = scandir( basein("assets/js/extras") );
foreach ( $extras as $file ): if ( strlen($file) > 3 ): ?>

<script src="<?php print baseurl("assets/js/extras/" . $file . ""); ?>"></script>

<?php endif; endforeach; ?>