<html>
<head>
<title>Date RSS</title>
<link rel="stylesheet" href="https://profs.info.uaic.ro/~busaco/teach/courses/web/web.css" /> 
</head>
<body>
<h1>Date RSS de la InfoQ</h1>
<?php
define ('FEED', 'https://feed.infoq.com/'); 	// adresa fluxului de știri RSS
define ('XPATH', '/rss/channel/item');          // expresia XPath utilizată

try {
  $dom = new DomDocument();
  $dom->load (FEED); // încărcăm documentul XML
  $xpath = new DOMXpath($dom);
  // baleiăm însemnările (aici, elementele <item>) 
  $items = $xpath->query (XPATH);
  foreach ($items as $news) {
    // preluăm titlul fiecărei știri
    echo '<p>Noutate: <em>' . 
      $news->getElementsByTagname('title')->item(0)->nodeValue . 
      '</em></p>'; 
    echo '<p>Calea nodului: <code>' . 
      $news->getElementsByTagname('title')->item(0)->getNodePath() . 
      '</code></p>'; 
  }
  // statistici
  echo '<p>Total apariții de elemente <code>&lt;item&gt;</code>:</p>';
  echo '<p>Folosind proprietatea length (DOMNodeList): ' . $items->length . '</p>';
  echo '<p>Folosind funcția XPath count(): ' . $xpath->evaluate ("count(" . XPATH . ")") . '</p>'; 

}
catch (RuntimeException $e) { 
  echo $e->getMessage (); 
}
?>
</body>
</html>
