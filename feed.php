<?php
    if(isset($_GET["type"])){
        if($_GET["type"] == "atom"){
            include("includes/atom.php");
        } else {
            include("includes/rss.php");
        }
    } else {
        include("includes/rss.php");
    }
?>