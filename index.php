<?php
require('lib/common.php');

$page = (isset($_GET['page']) ? str_replace('_', ' ', $_GET['page']) : 'Main Page');

$pagedata = fetch("SELECT p.*, r.content FROM wikipages p JOIN wikirevisions r ON p.cur_revision = r.revision WHERE p.title = ? AND r.page = ?", [$page, $page]);

$twig = _twigloader();
echo $twig->render('index.twig', [
	'pagetitle' => $page,
	'pagetitle_slugified' => str_replace(' ', '_', $page),
	'page' => $pagedata
]);
