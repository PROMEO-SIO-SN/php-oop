# 2. Les namespaces

Les espaces de noms (namespaces) sont utiles pour classer nos objet, imaginons nous avons un site e-commerce et nous mettons à disponibilité plusieurs méthodes de paiement.

Nous allons classé tout cela dans des dossiers: 

- Un dossier `Ecommerce`
- Un dossier `Paypal` et `Stripe` dans le dossier `Ecommerce`
- Dans les dossiers `Paypal` et `Stripe` nous allons créer une class `Payment` :
    
    ```php
    <?php
    
    class Payment
    {
    
    }
    ```
    

On va pouvoir commencer à tester dans notre `index.php` :

```php
<?php
require_once 'Ecommerce/Paypal/Payment.php';
require_once 'Ecommerce/Stripe/Payment.php';

$payment = new Payment();

var_dump($payment);
```

Nous allons avoir une erreur: “Cannot declare class Payment, because the name is already in use”
Certains diront qu’on devrait renommer nos class en `PaypalPayment` et `StripePayment` , et bien ce n’est pas vraiment une bonne solution, c’est plutôt l’option de facilité.

Pour résoudre ce problème nous allons utiliser les namespaces:

```php
<?php

namespace Ecommerce\Paypal;

class Payment
{

}
```

```php
<?php

namespace Ecommerce\Stripe;

class Payment
{

}
```

```php
<?php
require_once 'Ecommerce/Paypal/Payment.php';
require_once 'Ecommerce/Stripe/Payment.php';

// Modification en ajoutant le namespace de l'objet qu'on souhaite instancier
$payment = new \Ecommerce\Paypal\Payment();

var_dump($payment);
```

Nous n’avons plus d’erreur et nous pouvons voir le retour de `var_dump` , ici nous avons déclaré l’objet `Payment` qui se trouve dans `Ecommerce\Paypal` .

Cependant, nous pouvons améliorer la syntaxe pour appeler notre objet, effectivement ajouter le namespace de notre objet à chaque fois c’est redondant et pas très lisible.

```php
<?php
require_once 'Ecommerce/Paypal/Payment.php';
require_once 'Ecommerce/Stripe/Payment.php';

$paymentPaypal = new \Ecommerce\Paypal\Payment();
$paymentStripe = new \Ecommerce\Stripe\Payment();

var_dump($paymentPaypal, $paymentStripe);
```

Nous pouvons alors utilise le mot-clé `use` :

```php
<?php
require_once 'Ecommerce/Paypal/Payment.php';
require_once 'Ecommerce/Stripe/Payment.php';

use Ecommerce\Paypal\Payment;
use Ecommerce\Stripe\Payment;

$paymentPaypal = new Payment();
$paymentStripe = new Payment();

var_dump($paymentPaypal, $paymentStripe);
```

C’est déjà plus lisible mais on va avoir une erreur car à l’instanciation de `Payment` nous ne savons pas quel namespace utiliser, nous allons ajouter un autre mot-clé `as` en complément de `use` et appeler directement les nouveaux nom qu’on leurs attribut :

```php
<?php
require_once 'Ecommerce/Paypal/Payment.php';
require_once 'Ecommerce/Stripe/Payment.php';

use Ecommerce\Paypal\Payment as PaypalPayment;
use Ecommerce\Stripe\Payment as StripePayment;

$paymentPaypal = new PaypalPayment();
$paymentStripe = new StripePayment();

var_dump($paymentPaypal, $paymentStripe);
```

Et ici, plus de problème !
