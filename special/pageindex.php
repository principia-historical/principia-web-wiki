<?php
$pages = query("SELECT title FROM wikipages ORDER BY title ASC");

$twig = _twigloader();
echo $twig->render('pageindex.twig', [
	'pages' => $pages
]);
