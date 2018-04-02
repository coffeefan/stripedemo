<html>
<head>
  <title>STRIPE DEMO</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<form id="conf" action="/step1.php" method="post" >
  <h3>Konfiguration Stripe</h3>
  <p>Public API-Key:*<br/>
  <input type="text" name="api_key_public" value="<?php echo $_REQUEST["api_key_public"];?>" required /></p>
  <p>Private API-Key:*<br/>
  <input type="text" name="api_key_private" value="<?php echo $_REQUEST["api_key_private"];?>" required /></p>
  <p>Order Description:*<br/>
  <input type="text" name="stripe_description" value="<?php echo $_REQUEST["stripe_description"];?>" required  /></p>

  <h3>Order Simulation</h3>
  <p>OrderId<br/>
  <input type="text" name="order_id" value="<?php echo $_REQUEST["order_id"];?>"  /></p>

  <p>Totalkosten der Bestellung (in CHF)*<br/>
  <input type="text" name="order_amount" value="<?php echo $_REQUEST["order_amount"];?>" required  /></p>

  <p>E-Mail<br/>
  <input type="text" name="email" value="<?php echo $_REQUEST["email"];?>" required/></p>
<p>
  <button type="submit" name="submit" value="order">Bestellen</button></p>
</form>
</body>
</html>
