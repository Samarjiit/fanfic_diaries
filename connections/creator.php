<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
 if (isset($_GET['creator-id'])) {

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  $creator_id = htmlentities(strtolower($_GET['creator-id'])); //FJEkejfdkf = fjekjfdkf

  $ts = time();
  $public_key = '34f8026eaf0324a6bb119eba09048b8f';
  $private_key = '08fa3417660dab81451a06011414fcfedf0ecdde';
  $hash = md5($ts . $private_key . $public_key);

  $query = array(
   'apikey' => $public_key,
   'ts' => $ts,
   'hash' => $hash,
  );

  curl_setopt($curl, CURLOPT_URL,
   "https://gateway.marvel.com:443/v1/public/creators/" . $creator_id . "?" . http_build_query($query)
  );

  $result = json_decode(curl_exec($curl), true);

  curl_close($curl);

  echo json_encode($result);

 } else {
  echo "Error comic-id invalid.";
 }
} else {
 echo "Error: wrong server.";
}