<?

ini_set('display_errors',1); 
error_reporting(E_ALL);

require 'list.php';
require 'filter.php';
require 'config.php';
require 'imdbLinks.php';
require 'details.php';
require 'shortcuts.php';

createList($basePath);

$movieList = explode("\n", file_get_contents('movieList.txt'));
filter($movieList);
getIMDBLinks($movieList);
$links = explode("\n", file_get_contents('imdbLinks.txt'));

getDetails($links);

$details = json_decode(file_get_contents('details.txt'), true);
$fileList = json_decode(file_get_contents('fileList.txt'), true);

createShortcuts($details, $createPath, $fileList);

?>