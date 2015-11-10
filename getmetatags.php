<?php

	require_once __DIR__."/src/MetaTagExtractor.php";

	if (sizeof($_SERVER["argv"])!=2)
		exit("Usage: getmetatags.php <url>");

	$url=$_SERVER["argv"][1];

	$keywords=MetaTagExtractor::getKeywordsForUrl($url);
	print_r($keywords);