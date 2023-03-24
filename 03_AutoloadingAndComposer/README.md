# 3. Autoloading et Composer

## Autoloading

Nous allons utiliser le code fait dans le chapitre sur les namespaces.

Nous avons beaucoup utilisé le mot-clé `require` ou `require_once` jusqu’à présent, cela permettait d’importer le code d’autre fichier php dans l’index.php.
Cependant, dans des projets plus complexe avec beaucoup d’objet on va très vite arriver au moment où notre code sera plus compliqué à maintenir et à faire évoluer.

C’est pour cela que php mets à disposition une fonction de chargement automatique (autoload) des différentes class disponible dans notre projet, plus besoin de faire des dizaine ou centaine de `require` ou `require_once` .

Voici notre autoloader:

```php
<?php
// AUTOLOADER
spl_autoload_register(function ($class) {
   $path = str_replace('\\', '/', $class) . '.php';

   if (file_exists($path)) {
       require $path;
   }
});

use Ecommerce\Paypal\Payment as PaypalPayment;
use Ecommerce\Stripe\Payment as StripePayment;

$paymentPaypal = new PaypalPayment();
$paymentStripe = new StripePayment();

var_dump($paymentPaypal, $paymentStripe);
```

Ceci est notre propre autoloader, il peut changer en fonction des configurations de votre projet, il est actuellement adapté au TP.

## Composer

Composer c’est quoi ? Composer est un gestionnaire de package PHP, c’est en quelque sorte une grande bibliothèque de librairie libre service. Vous pouvons trouver plein de librairie qui vous permettra d’éviter de réinventer la roue et utiliser des système pré-fait.

- Il doit s’installer sur votre PC, si vous avez Laragon il est déjà installé, il faut l’installer manuellement sur Linux et MacOS.
- Une fois installé, vous pouvez effectuer la commande `composer` si vous voyez toutes les commandes c’est qu’il est bien installé sinon revoyez l’installation.

### Utilisation

Pour initialiser composer dans notre projet on va utiliser la commande `composer init` , une fois la commande lancé on vous demande les configurations de composer, on va laisser par défaut et appuyer sur entré jusqu’à la fin.

<aside>
💡 Pour un projet déjà initialiser avec composer vous pouvez directement installer les packages avec la commande `composer install` .

</aside>

Nous avons un dossier et 1 fichier qui ont été créé:

- Dossier vendor: c’est le dossier qui contiendra toutes les librairies qu’on installera sur notre projet.
- Fichier composer.json: C’est la configuration de composer et les librairies qu’on aura installé.

Dans un premier nous allons changer la configuration `autoload` de composer pour qu’elle corresponde à notre projet:

```json
//...

"autoload": {
    "psr-4": {
        "Ecommerce\\": "Ecommerce/"
    }
},

//...
```

```php
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

$paymentPaypal = new PaypalPayment();
$paymentStripe = new StripePayment();

var_dump($paymentPaypal, $paymentStripe);
```

Une fois terminé, on va lancer la commande `composer dump-autoload` , elle va permettre à composer de se mettre à jour avec le nouveau autoload.

Vous avez remarqué que nous n’utiliserons plus notre autoloader mais celui de composer.

### Librairie

Toutes les librairies disponible sont sur le site [https://packagist.org/](https://packagist.org/).

Nous allons en installer Carbon: [https://packagist.org/packages/nesbot/carbon](https://packagist.org/packages/nesbot/carbon)
La documentation vous donne une commande pour ajouter la librairie `composer require <nom librairie>` , c’est cette commande pour installer une librairie.

Nous avons maintenant un nouveau fichier:

- composer.lock: il stocke les informations des librairies à l’instant T.

Pour utiliser notre librairie Carbon:

```php
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

// Use Carbon
use Carbon\Carbon;

$paymentPaypal = new PaypalPayment();
$paymentStripe = new StripePayment();

var_dump($paymentPaypal, $paymentStripe);

// Affiche la date du jour avec le bon format
echo '<pre>' . Carbon::now()->format('d/m/Y') . '</pre>';
```
### Commandes les plus utiles

- `composer init`: initialiser composer dans un dossier
- `composer install`: Installer les packages lorsqu'il y a déjà un composer.json
- `composer dump-autoload`: Mettre à jour la configuration de composer
- `composer update`: Mettre à jour les packages