<?php
require('lib/common.php');

$page = (isset($_GET['page']) ? str_replace('_', ' ', $_GET['page']) : 'Main Page');
$revision = $_GET['rev'] ?? null;

if ($revision) {
	$pagedata = fetch("SELECT p.*, r.content FROM wikipages p JOIN wikirevisions r ON ? = r.revision WHERE BINARY p.title = ? AND BINARY r.page = ?", [$revision, $page, $page]);

	$revdata = fetch("SELECT $userfields r.* FROM wikirevisions r JOIN users u ON r.author = u.id WHERE BINARY r.page = ? AND r.revision = ?", [$page, $revision]);
} else {
	$pagedata = fetch("SELECT p.*, r.content FROM wikipages p JOIN wikirevisions r ON p.cur_revision = r.revision WHERE BINARY p.title = ? AND BINARY r.page = ?", [$page, $page]);

}

$twig = _twigloader();
echo $twig->render('index.twig', [
	'pagetitle' => $page,
	'pagetitle_slugified' => str_replace(' ', '_', $page),
	'page' => $pagedata,
	'revision' => $revision,
	'revdata' => $revdata ?? null
]);
