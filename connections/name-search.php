<?php
//if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
 if (isset($_GET['name'])) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $name_to_search= htmlentities(strtolower($_GET['name']));

  //$character_id = $_GET['character-id'];

  $ts = time();
  $public_key = '34f8026eaf0324a6bb119eba09048b8f';
  $private_key = '08fa3417660dab81451a06011414fcfedf0ecdde';
  $hash = md5($ts . $private_key . $public_key);

  $query = array(
   'name' => $name_to_search,
   'orderBy' => 'name',
   'apikey' => $public_key,
   'ts' => $ts,
   'hash' => $hash
  );

  curl_setopt($curl, CURLOPT_URL,
   "https://gateway.marvel.com:443/v1/public/characters?" . http_build_query($query)
  );

  $result = json_decode(curl_exec($curl), true);

  curl_close($curl);

  echo json_encode($result);

 } else {
 echo "Error: wrong server.";
}
?>