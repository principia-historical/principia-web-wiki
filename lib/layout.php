<?php

function _twigloader($subfolder = '') {
	$twig = twigloader($subfolder, function () use ($subfolder) {
		return new \Twig\Loader\FilesystemLoader('templates/' . $subfolder);
	}, function ($loader, $doCache) {

		return new \Twig\Environment($loader, [
			'cache' => ($doCache ? "../".$doCache : $doCache),
		]);
	});

	return $twig;
}
