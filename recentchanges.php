<?php
require('lib/common.php');

$revisions = query("SELECT $userfields r.page, r.revision, r.size, r.sizediff, r.time FROM wikirevisions r JOIN users u ON r.author = u.id ORDER BY r.time DESC LIMIT 50");

$twig = _twigloader();
echo $twig->render('recentchanges.twig', [
	'revisions' => $revisions
]);
