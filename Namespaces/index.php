<?php
require_once 'Ecommerce/Paypal/Payment.php';
require_once 'Ecommerce/Stripe/Payment.php';

use Ecommerce\Paypal\Payment as PaypalPayment;
use Ecommerce\Stripe\Payment as StripePayment;

$paymentPaypal = new PaypalPayment();
$paymentStripe = new StripePayment();

var_dump($paymentPaypal, $paymentStripe);