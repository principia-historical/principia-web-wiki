#!/usr/bin/php
<?php

print("principia-web wiki tools - feed-data.php\n");
print("==================================================\n");
print("Import data from 'tools/outdata.json' into the wiki.\n\n");

require('lib/common.php');

$data = json_decode(file_get_contents("tools/outdata.json"));

foreach ($data as $pagename => $content) {
	query("INSERT INTO wikipages (title) VALUES (?)",
		[$pagename]);

	$content = normalise($content);

	query("INSERT INTO wikirevisions (page, author, time, size, description, content) VALUES (?,?,?,?,?,?)",
		[$pagename, 1, time(), strlen($content), 'Automatic import from script', $content]);
}
