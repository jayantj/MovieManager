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
	for($i = 20; $i < 100; $i++)
	{
		foreach ($details[$i] as $key => $value) 
		{
			if(is_array($value))
			{
				foreach ($value as $index => $category) 
				{
					if(!is_dir($createPath.$category))
						shell_exec("mkdir $createPath$category");

					if(!file_exists($createPath.$category."/".$details[$i]["title"]))
					{	
						$title = escapeshellarg($details[$i]["title"]);
						$target = escapeshellarg($fileList[$i]);

						//echo "ln -s $target $createPath$category/$title\n";
						shell_exec("ln -s $target $createPath$category/$title\n");
					}
				}
			}
		}

	}
}

?>