<?php
    date_default_timezone_set("America/Chicago");
    file_put_contents("activity.txt", date("l, F jS, Y")."\n");
?>