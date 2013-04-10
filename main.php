<?

ini_set('display_errors',1); 
error_reporting(E_ALL);

require 'list.php';
require 'filter.php';
require 'config.php';
require 'imdbLinks.php';

//$basePath = '/media/win7/Movies/';
createList($basePath);

$movieList = explode("\n", file_get_contents('movieList.txt'));

filter($movieList);
getIMDBLinks($movieList);

$links = explode("\n", file_get_contents('imdbLinks.txt'));

getDetails($links);
?>