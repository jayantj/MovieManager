<?

function createShortcuts($details, $createPath, $fileList)
{
/*
	$filePath = 'details.txt';
	$createPath = '/home/jayant/movies/categories/';

	$details = json_decode(file_get_contents($filePath), true);
	$fileList = json_decode(file_get_contents('fileList.txt'), true);
	//print_r($fileList);
*/
	for($i = 0; $i < sizeof($details); $i++)
	{
		foreach ($details[$i] as $key => $value) 
		{
			if(is_array($value))
			{
				foreach ($value as $index => $category) 
				{
					if(!is_dir($createPath.$category))
						shell_exec("mkdir $createPath$category");

					$title = str_replace('/', ' ', $details[$i]["title"]);
					$rating = $details[$i]["rating"];
					$description = $details[$i]["description"];

					$fh = fopen("$createPath$category/$rating - $title.txt", 'w');
					fwrite($fh, $description);

					if(!file_exists("$createPath$category/$rating - $title"))
					{	
						$target = escapeshellarg($fileList[$i]);
						$rating = escapeshellarg($rating);
						$title = escapeshellarg($title);

						//echo "ln -s $target $createPath$category/$title\n";
						shell_exec("ln -s $target $createPath$category/$rating\ -\ $title");
					}
					else
						;//echo "wohoo\n";

				/*	if(file_exists("$createPath$category/$rating - $title.txt"))
						unlink("$createPath$category/$rating - $title.txt");/*
					$fh = fopen("$createPath$category/$rating - $title.txt", 'w');
						fwrite($fh, $description);*/
				}
			}
		}
	}
}
?>