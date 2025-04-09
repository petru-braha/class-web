<?php
// Program PHP 7 privind (de)codificarea de date interne<->date JSON

// piesele albumului 'Animals' de Pink Floyd (1977)
$animals = [ "🐷 on the Wing #1", "Dogs 🐕", 
  [ "🐖🐖🐖" => "Pigs (Three Different Ones)" ], 
  "Sheep 🐑", "🐷 on the Wing #2" ];
// codificam (serializam) in JSON
$json = json_encode ($animals);
// decodificam datele JSON
$animals2 = json_decode ($json); 
// redam date despre variabilele folosite
var_dump ($animals, $animals2, $json);

/* Rezultatele oferite:

array(5) {
  [0]=>
  string(19) "🐷 on the Wing #1"
  [1]=>
  string(16) "Dogs 🐕"
  [2]=>
  array(1) {
    ["🐖🐖🐖"]=>
    string(27) "Pigs (Three Different Ones)"
  }
  [3]=>
  string(10) "Sheep 🐑"
  [4]=>
  string(19) "🐷 on the Wing #2"
}
array(5) {
  [0]=>
  string(19) "🐷 on the Wing #1"
  [1]=>
  string(16) "Dogs 🐕"
  [2]=>
  object(stdClass)#1 (1) {
    ["🐖🐖🐖"]=>
    string(27) "Pigs (Three Different Ones)"
  }
  [3]=>
  string(10) "Sheep 🐑"
  [4]=>
  string(19) "🐷 on the Wing #2"
}
string(191) "["\ud83d\udc37 on the Wing #1","Dogs \ud83d\udc15\u200d\ud83e\uddba",{"\ud83d\udc16\ud83d\udc16\ud83d\udc16":"Pigs (Three Different Ones)"},"Sheep \ud83d\udc11","\ud83d\udc37 on the Wing #2"]"

*/