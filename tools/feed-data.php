#!/bin/bash
<?php
require('lib/common.php');

$data = json_decode(file_get_contents("tools/outdata.json"));

foreach ($data as $pagename => $content) {
	query("INSERT INTO wikipages (title) VALUES (?)",
		[$pagename]);

	query("INSERT INTO wikirevisions (page, author, time, size, description, content) VALUES (?,?,?,?,?,?)",
		[$pagename, 1, time(), strlen($content), 'Automatic import from script', $content]);
}
