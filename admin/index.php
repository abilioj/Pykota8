<?php
include '../vendor/autoload.php';
use _lib\raelgc\view\Template;

$tpl = new Template("./view/home.html");
$tpl->addFile("links","./view/include/linksCSS.html");
$tpl->addFile("header","./view/include/header.html");
$tpl->addFile("footer","./view/include/footer.html");

$tpl->title = "home - test";
$tpl->show();
