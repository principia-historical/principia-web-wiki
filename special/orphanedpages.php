<?php

// Generates a list of "orphaned" pages, not linked from anywhere else on the wiki.

$pagecontent = query("SELECT p.title, r.content FROM wikipages p JOIN wikirevisions r ON p.cur_revision = r.revision AND p.title = r.page");

$pages = query("SELECT title FROM wikipages p");

// Iterate over page contents, get a list of linked pages.
$linkedpages = [];
foreach ($pagecontent as $page) {
	preg_match_all('/\[\[(.*?)\]\]/', $page['content'], $links);
	foreach ($links[1] as $link)
		$linkedpages[$link] = true;
}

// Iterate over pages, any pages not existing in $linkedpages is an orphan!
$orphanedpages = [];
foreach ($pages as $page) {
	if (!isset($linkedpages[$page['title']]))
		$orphanedpages[] = $page['title'];
}

echo _twigloader()->render('orphanedpages.twig', [
	'orphanedpages' => $orphanedpages
]);
