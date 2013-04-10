<?

/*
$movieList = explode("\n", file_get_contents('movieList.txt'));
array_pop($movieList);*/

require 'config.php';

function getIMDBLink($movie, $searchLink)
{
	$str = str_replace(' ','+', $movie);
	$searchResults = file_get_contents($searchLink.$str);
	preg_match("/http:\/\/www\.imdb\.com\/title\/tt[0-9]+\//", $searchResults, $link);

	return $link;
}

function getIMDBLinks($movieList)
{
	global $searchLink1, $searchLink2;
	
	$imdbLinks = array();

	print_r($movieList[0]);
	for($i = 0; $i < sizeof($movieList); $i++)
	{
		if($link = getIMDBLink($movieList[$i], $searchLink1))
			$imdbLinks[] = $link[0];
		else if($link = getIMDBLink($movieList[$i], $searchLink2))
			$imdbLinks[] = $link[0];
		else
			$imdbLinks[] = "";
		print_r($link);
		echo "$i\n";
	}	

	$fh = fopen('imdbLinks.txt', 'w');

	for($i = 0; $i < sizeof($imdbLinks); $i++)
		fwrite($fh, $imdbLinks[$i]."\n");
}

?>