<?php
require('lib/common.php');

$page = (isset($_GET['page']) ? str_replace('_', ' ', $_GET['page']) : 'Main Page');
$page_slugified = (isset($_GET['page']) ? $_GET['page'] : 'Main_Page');

$pagedata = fetch("SELECT * FROM wikipages WHERE BINARY title = ?", [$page]);

if (!$pagedata) error('404', 'Invalid page name.');

$revisions = query("SELECT $userfields r.revision, r.size, r.sizediff, r.time, r.description FROM wikirevisions r JOIN users u ON r.author = u.id WHERE BINARY r.page = ? ORDER BY r.revision DESC", [$page]);

$twig = _twigloader();
echo $twig->render('viewhistory.twig', [
	'pagetitle' => $page,
	'pagetitle_slugified' => str_replace(' ', '_', $page),
	'pagedata' => $pagedata,
	'revisions' => $revisions
]);
