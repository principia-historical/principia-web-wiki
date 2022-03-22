<?php
require('lib/common.php');

$page = (isset($_GET['page']) ? str_replace('_', ' ', $_GET['page']) : 'Main Page');

$pagedata = fetch("SELECT * FROM wikipages WHERE title = ?", [$page]);

$twig = _twigloader();
echo $twig->render('index.twig', [
	'pagetitle' => $page,
	'pagetitle_slugified' => str_replace(' ', '_', $page),
	'page' => $pagedata
]);
