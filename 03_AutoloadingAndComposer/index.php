<?php
/* AUTOLOADER
spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class) . '.php';

    if (file_exists($path)) {
        require $path;
    }
});*/

require 'vendor/autoload.php';

use Ecommerce\Paypal\Payment as PaypalPayment;
use Ecommerce\Stripe\Payment as StripePayment;
use Carbon\Carbon;

$paymentPaypal = new PaypalPayment();
$paymentStripe = new StripePayment();

var_dump($paymentPaypal, $paymentStripe);

echo '<pre>' . Carbon::now()->format('d/m/Y') . '</pre>';