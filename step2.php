<html>
<head>
  <title>STRIPE DEMO</title>
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


$feedback=makeRESTAPICharge(
  $_REQUEST["token"],
  $_SESSION["order"]["orderid"],
  $_SESSION["order"]["order_amount"],
  $_SESSION["stripe_description"],
  $_SESSION["api_key_private"]);

if($feedback["errortxt"]=='none'){
  echo "Vielen Dank für ihren Einkauf";
}else{
  echo "Es ist ein Fehler aufgetaucht:<br/>".
  $feedback["errortxt"];
}

function makeRESTAPICharge($order_token,$order_id,$order_amount,$stripe_description,$api_key_private){
  $feedback["errortxt"]=true;
  /*REST CALL:
  curl https://api.stripe.com/v1/charges \
    -u API_KEY_PRIVATE: \
    -d amount=ORDER_AMOUNT \
    -d currency=chf \
    -d description=STRIPE_DESCRIPTION \
    -d source=ORDER_TOKEN
  */

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/charges");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,
    "amount=".($order_amount)."&currency=chf&description=\"".
     $stripe_description."\"&source=".$order_token
."&metadata[order_id]=".$order_id
   );
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_USERPWD, $api_key_private . ":" . "");
  $headers = array();
  $headers[] = "Content-Type: application/x-www-form-urlencoded";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec($ch);
  $feedback["result"]=$result;

  if (curl_errno($ch)) {
    $feedback["errortxt"]='Error:' . curl_error($ch);
  }else{
    $feedback["errortxt"]='none';
  }
  curl_close ($ch);
  return $feedback;
}
?>
</body>
</html>
