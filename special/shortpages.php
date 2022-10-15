<?php
$shortpages = query("SELECT p.title, r.size FROM wikipages p JOIN wikirevisions r ON p.cur_revision = r.revision AND p.title = r.page ORDER BY r.size ASC, p.title LIMIT 50");

$twig = _twigloader();
echo $twig->render('shortpages.twig', [
	'shortpages' => $shortpages
]);
