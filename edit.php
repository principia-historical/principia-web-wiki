<?php
require('lib/common.php');

$page = (isset($_GET['page']) ? str_replace('_', ' ', $_GET['page']) : 'Main Page');
$page_slugified = (isset($_GET['page']) ? $_GET['page'] : 'Main_Page');

$pagedata = fetch("SELECT * FROM wikipages WHERE title = ?", [$page]);

if ($log && isset($_POST['action'])) {
	if ($pagedata) {
		query("UPDATE wikipages SET content = ? WHERE title = ?",
			[$_POST['text'], $page]);
	} else {
		query("INSERT INTO wikipages (title, content) VALUES (?,?)",
			[$page, $_POST['text']]);
	}

	redirect("/wiki/$page_slugified");
}

$twig = _twigloader();
echo $twig->render('edit.twig', [
	'pagetitle' => $page,
	'pagetitle_slugified' => str_replace(' ', '_', $page),
	'page' => $pagedata
]);
