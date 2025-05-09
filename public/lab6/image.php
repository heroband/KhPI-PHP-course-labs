<?php
header("Content-Type: image/png");
header("Cache-Control: public, max-age=86400");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 86400));

readfile("image.png");
?>