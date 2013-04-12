<?
/*
$filePath = 'imdbLinks.txt';

$links = explode("\n", file_get_contents($filePath));
*/

function getDetails($links)
{
	$details = array();
	for($i = 0; $i < sizeof($links); $i++)
	{
		$page = file_get_contents($links[$i]);		
		//echo $page;

		preg_match_all("/\"genre\">[a-zA-Z]*<\/span>/", $page, $category);
		preg_match_all("/\"ratingValue\">[0-9]\.[0-9]<\/span>/", $page, $rating);
		preg_match_all("/\"name\">[^<^>]*<\/span>/", $page, $title);
		preg_match_all("/<p>[^>]*<em class=\"nobr\">/s", $page, $description);

		foreach ($category[0] as $key => $value) 
		{
			$categories[$i][] = substr($value, 8, -7);
		}

		$details[$i]["categories"] = $categories[$i];
		$details[$i]["rating"] = substr($rating[0][0], 14, -7);
		$details[$i]["title"] = substr($title[0][0], 7, -7);
		$details[$i]["description"] = substr($description[0][0], 4, -17);
		print_r($details[$i]);
		echo $i . "\n";
	} 

	$fh = fopen('details.txt', 'w');
	fwrite($fh, json_encode($details));
}
?>