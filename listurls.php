<?php
/*
 * First authored by Brian Cray
 * License: http://creativecommons.org/licenses/by/3.0/
 * Contact the author at http://briancray.com/
 */
 
ini_set('display_errors', 0);

/* $url_to_shorten = get_magic_quotes_gpc() ? stripslashes(trim($_REQUEST['longurl'])) : trim($_REQUEST['longurl']); */
/* $custom_shorten_url = $_REQUEST['shorturl']; */


require('config.php');

/*
mysql_query('LOCK TABLES ' . DB_TABLE . ' WRITE;');
mysql_query('INSERT INTO ' . DB_TABLE . ' (id, long_url, created, creator) VALUES ("' . $shortened_id . '", "' . mysql_real_escape_string($url_to_shorten) . '", "' . time() . '", "' . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . '")');
mysql_query('UNLOCK TABLES');
*/

$result = mysql_query('SELECT id, long_url FROM ' . DB_TABLE);

/*
$shortened_url = getShortenedURLFromID ($shortened_id);
$shortened_id = getIDFromShortenedURL ($custom_shorten_url);
*/

/* echo BASE_HREF . $url_list; */
/* echo $url_list; */

while ($row = mysql_fetch_assoc($result)) {
    echo BASE_HREF . getShortenedURLFromID ($row['id']) . " -> ";
    echo $row['long_url'];
    echo "<br>";
}

mysql_free_result($result);

function getShortenedURLFromID ($integer, $base = ALLOWED_CHARS)
{
	$length = strlen($base);
	while($integer > $length - 1)
	{
		$out = $base[fmod($integer, $length)] . $out;
		$integer = floor( $integer / $length );
	}
	return $base[$integer] . $out;
}

function getIDFromShortenedURL ($string, $base = ALLOWED_CHARS)
{
	$length = strlen($base);
	$size = strlen($string) - 1;
	$string = str_split($string);
	$out = strpos($base, array_pop($string));
	foreach($string as $i => $char)
	{
		$out += strpos($base, $char) * pow($length, $size - $i);
	}
	return $out;
}