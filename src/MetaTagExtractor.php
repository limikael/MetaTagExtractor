<?php

	require_once __DIR__."/../vendor/autoload.php";

	use Sunra\PhpSimple\HtmlDomParser;

	/**
	 * Extract meta tags.
	 */
	class MetaTagExtractor {

		/**
		 * Get keywords for url.
		 */
		public static function getKeywordsForUrl($url) {
			$curl=curl_init();
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
			curl_setopt($curl,CURLOPT_URL,$url);
			$body=curl_exec($curl);

			$code=curl_getinfo($curl, CURLINFO_HTTP_CODE);
			if ($code!=200)
				throw new Exception("Unable to fetch url",$code);

			$dom=HtmlDomParser::str_get_html($body);
			$keywords=[];

			foreach ($dom->find("meta") as $meta) {
				if ($meta->name=="keywords") {
					$untrimmedKeywords=explode(",",$meta->content);

					foreach ($untrimmedKeywords as $untrimmedKeyword)
						$keywords[]=trim($untrimmedKeyword);
				}
			}

			return $keywords;
		}
	}