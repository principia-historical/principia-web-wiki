<?php

function parsing($text) {
	$markdown = new ParsedownToC();
	$markdown->setSafeMode(true);

	$text = $markdown->text($text);

	$text = preg_replace_callback('@{{ ([\w\d\.]+)\((.+?)\) }}@si', 'parseFunctions', $text);

	return $text;
}

function parseFunctions($match) {
	$cmd = sprintf(
		"luajit lib/lua/bootstrap.lua %s %s 2>&1",
	escapeshellarg($match[1]), escapeshellarg($match[2]));

	exec($cmd, $output);
	return implode('', $output);
}
