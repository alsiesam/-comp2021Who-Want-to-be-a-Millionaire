#!/usr/local/bin/php
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>


<body>
<div class="Jumbotron">

<?php

echo "<h1>Game 1 - Maze Runner</h1>";
echo "<p>Press \"up\", \"down\", \"left\" and \"right\" on your keyboard to control the avatar</p>";

$map = array(
    array("#","#","#","#","#"),
    array("#","*","#","#","#"),
    array("#","*","*","*","#"),
    array("#","*","#","*","#"),
    array("S","*","#","*","D")
);
for ($count=0; $count<count($map); $count++){
    for ($count2=0;$count2<count($map[$count]);$count2++){
        echo $map[$count][$count2]." ";
    }
    echo "<br>";
}

?>
</div>
</body>
</html>