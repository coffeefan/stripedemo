<?php
/*OrderArray from checkout
normally DB-Object, DEMO-Fake: Session
No Validation
*/
session_start();
$order["order_amount"]=$_REQUEST["order_amount"]*100;
$order["orderid"]=$_REQUEST["order_id"];
$order["email"]=$_REQUEST["email"];
$_SESSION["order"]=$order;

$_SESSION["api_key_public"]=$_REQUEST["api_key_public"];
$_SESSION["api_key_private"]=$_REQUEST["api_key_private"];
$_SESSION["stripe_description"]=$_REQUEST["stripe_description"];
?>

<html>
<head>
  <title>STRIPE DEMO</title>
  <link rel="stylesheet" href="css/style.css" />

  <!-- EASY Integration
  </head>
  <body>
    <form action="step2.php" method="POST">
      <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $_SESSION["api_key_public"];?>"
        data-amount="<?php echo $_SESSION["order_amount"];?>"
        data-email="<?php echo $_SESSION["order"]["email"];?>"
        data-name="fotobachmann.ch"
        data-description="Widget"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-zip-code="true"
        data-currency="chf"
        data-label="Kreditkartenzahlung"
        >
      </script>
    </form>
    <body>
  -->

  <!--Advanced Integration Start: -->

  <script src="https://checkout.stripe.com/checkout.js"></script>
  <script>
  //POST-Redirect
  function redirectPost(url, data) {
      var form = document.createElement('form');
      document.body.appendChild(form);
      form.method = 'post';
      form.action = url;
      for (var name in data) {
          var input = document.createElement('input');
          input.type = 'hidden';
          input.name = name;
          input.value = data[name];
          form.appendChild(input);
      }
      form.submit();
  }


  //Basic Strip-Code
  var handler = StripeCheckout.configure({
    key: '<?php echo $_SESSION["api_key_public"];?>',
    email: '<?php echo $_SESSION["order"]["email"];?>',
    image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
    locale: 'auto',
    token: function(token) {
      redirectPost('step2.php', {token:token.id,});
    }
  });

document.addEventListener("DOMContentLoaded", function() {
  document.getElementById('customButton').addEventListener('click', function(e) {
    // Open Checkout with further options:
    handler.open({
      name: 'fotobachmann.ch',
      description: 'Payment Gateway',

      zipCode: false,
      currency: 'chf',
      amount: '<?php echo $_SESSION["order"]["order_amount"];?>'
    });
    e.preventDefault();
  });
  window.addEventListener('popstate', function() {
    handler.close();
  });

});
  </script>
</head>

<body>



<button id="customButton">Kreditkarten Zahlung</button>


<body>
</html>
