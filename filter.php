<?
require 'config.php';

	function generalReplacement(&$movieList, $arr)
	{
		for($i = 0; $i < sizeof($movieList); $i++)
			foreach ($arr as $key => $value) {
				$movieList[$i] = preg_replace("/$key/i", $value, $movieList[$i]);
			}
	}

	function caseSensitiveReplacement(&$movieList, $arr)
	{
		for($i = 0; $i < sizeof($movieList); $i++)
			foreach ($arr as $key => $value) 
			{
				$movieList[$i] = preg_replace("/$key/", $value, $movieList[$i]);
			}
	}

	function torrentReplacement(&$movieList, $arr)
	{
		for($i = 0; $i < sizeof($movieList); $i++)
			foreach ($arr as $key => $value) {
				$movieList[$i] = preg_replace("/$key/i", $value, $movieList[$i]);
			}
	}

function filter(&$movieList)
{
	global $generalReplacement, $torrentReplacement;

	array_pop($movieList);
	generalReplacement($movieList, $generalReplacement);
	torrentReplacement($movieList, $torrentReplacement);

	print_r($movieList);
	$fh = fopen('movieList.txt', 'w');

	foreach ($movieList as $key => $value) 
	{
		fwrite($fh, $value."\n");
	}
}
?>