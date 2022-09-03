<?php
require('lib/common.php');

$page = (isset($_GET['page']) ? str_replace('_', ' ', $_GET['page']) : 'Main Page');
$page_slugified = (isset($_GET['page']) ? $_GET['page'] : 'Main_Page');

$pagedata = fetch("SELECT p.*, r.content FROM wikipages p JOIN wikirevisions r ON p.cur_revision = r.revision WHERE p.title = ?", [$page]);

if ($log && isset($_POST['action'])) {
	$content = $_POST['text'] ?? '';
	$size = strlen($content);

	if ($pagedata) {
		query("UPDATE wikipages SET cur_revision = cur_revision + 1 WHERE title = ?",
			[$page]);

		$newrev = result("SELECT cur_revision FROM wikipages WHERE title = ?", [$page]);
		$oldsize = result("SELECT size FROM wikirevisions WHERE revision = ?", [$newrev-1]);

		query("INSERT INTO wikirevisions (page, revision, author, time, size, sizediff, content) VALUES (?,?,?,?,?,?,?)",
			[$page, $newrev, $userdata['id'], time(), $size, ($size - $oldsize), $content]);
	} else {
		query("INSERT INTO wikipages (title) VALUES (?)",
			[$page]);

		query("INSERT INTO wikirevisions (page, author, time, size, content) VALUES (?,?,?,?,?)",
			[$page, $userdata['id'], time(), $size, $content]);
	}

	redirect("/wiki/$page_slugified");
}

$twig = _twigloader();
echo $twig->render('edit.twig', [
	'pagetitle' => $page,
	'pagetitle_slugified' => str_replace(' ', '_', $page),
	'page' => $pagedata
]);
