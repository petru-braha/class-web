<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Show News</title>
<link rel="stylesheet" type="text/css" href="//profs.info.uaic.ro/~busaco/teach/courses/web/web.css" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
body {
	width: 100%;
}
.news {
	padding: 0.3em;
	margin: 0;
	float: left;
	width: 23%;
}
</style>
</head> 
<body>
<header>
<h1>News</h1>
</header>
<article>
<?php
/* Program PHP ce preia datele oferite de un flux RSS (document XML),
   pe baza unei expresii XPath.
*/   
define ('FEED', 'https://www.programmableweb.com/rss_blog'); // adresa fluxului de știri RSS
define ('XPATH', '/rss/channel/item'); // expresia XPath utilizată
define ('MAXSTR', 70);                 // lungimea maximă permisă (pentru afișarea descrierii știrii)

// funcție ce generează o legatură HTML spre resursă, oferind inclusiv descrierea ei
function genLink ($url, $newsTitle, $desc = '', $date = '') {
  return "<section class='news'><p><a href=\"$url\" title=\"$newsTitle\">$newsTitle</a></p><div>" .
    $desc . "</div><div class='info'>$date</div></section>";
}

try {
  // încărcăm documentul XML pe baza URL-ului furnizat
  $xml = simplexml_load_file (FEED);
  // baleiăm însemnările (elementele <item> din RSS) 
  foreach ($xml->xpath (XPATH) as $news) {
    $desc = strip_tags($news->description); // descrierea știrii după eliminarea marcajelor HTML
    $len = strlen($desc);  
  	echo genLink ($news->link, $news->title, substr($desc, 0, min($len, MAXSTR)) . '...', $news->pubDate);
  }
}
catch (RuntimeException $e) { 
    echo $e->getMessage();                  // a survenit o excepție
}
?>
</article>
</body>
</html>