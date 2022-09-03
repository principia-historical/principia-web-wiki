<?php
require('lib/common.php');

$page = (isset($_GET['page']) ? str_replace('_', ' ', $_GET['page']) : 'Main Page');
$page_slugified = (isset($_GET['page']) ? $_GET['page'] : 'Main_Page');

$pagedata = fetch("SELECT * FROM wikipages WHERE title = ?", [$page]);

$revisions = query("SELECT $userfields r.revision, r.size, r.sizediff, r.time FROM wikirevisions r JOIN users u ON r.author = u.id WHERE r.page = ? ORDER BY r.revision DESC", [$page]);

$twig = _twigloader();
echo $twig->render('viewhistory.twig', [
	'pagetitle' => $page,
	'pagetitle_slugified' => str_replace(' ', '_', $page),
	'pagedata' => $pagedata,
	'revisions' => $revisions
]);
