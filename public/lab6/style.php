<?php
header("Content-Type: text/css");
header("Cache-Control: public, max-age=86400");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 86400));

echo "
body {
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
}

p {
    color: #0077cc;
}
";
?>