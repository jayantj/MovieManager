<?
require 'config.php';

function strposa($haystack, $needles=array(), $offset=0) {
        $chr = array();
        foreach($needles as $needle) {
                $res = strpos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
}


$fileList = array();
$movieList = array();

function createList($basePath)
{
	global $movieList, $fileList;

	getList($basePath);
	
	$fh = fopen('movieList.txt', 'w');
	foreach ($movieList as $key => $value) {
		fwrite($fh, $value."\n");
	}

	$fh = fopen('fileList.txt', 'w');
	$json = json_encode($fileList);
	fwrite($fh, $json."\n");
}

function getList($dirPath)
{
	global $minimumSize, $allowedExtensions;
	global $fileList, $movieList, $basePath;

	if($handle = opendir($dirPath))
	{
		while (false !== ($entry = readdir($handle))) 
		{
			if($entry == "." || $entry == "..")
				continue;

			if(is_dir($dirPath.$entry))
			{
				getList($dirPath.$entry."/");
				//echo "wtf";
			}

			else if(is_file($dirPath.$entry))
			{
				$filesize = filesize($dirPath.$entry)/1048576;

				if(array_key_exists(pathinfo($dirPath.$entry, PATHINFO_EXTENSION), $allowedExtensions) && $filesize > $minimumSize)
					{
						$subdir = $dirPath != $basePath;

						$fileList[] = $subdir ? $dirPath : $dirPath.$entry;
						//$movieList[] = $subdir ? basename(dirname($dirPath.$entry)) : (pathinfo($dirPath.$entry, PATHINFO_FILENAME));
						$movieList[] = pathinfo($dirPath.$entry, PATHINFO_FILENAME);

					}
			}
		}
	}
	else
	{
		echo "ohhhh";
	}

	closedir($handle);
}

?>