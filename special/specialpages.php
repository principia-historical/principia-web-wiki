<?php

$specialpages = [
	'LongPages' => 'Long pages',
	'PageIndex' => 'Page index',
	'RecentChanges' => 'Recent changes',
	'ShortPages' => 'Short pages',
	'WantedPages' => 'Wanted pages'
];

$twig = _twigloader();
echo $twig->render('specialpages.twig', [
	'specialpages' => $specialpages
]);
