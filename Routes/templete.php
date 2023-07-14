<?php

ob_start();
?>
<h1>Profile</h1>
<?php
$content = ob_get_clean();
require_once("templete.php");


?>