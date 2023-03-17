# 1. Créer une classe

Pour créer une classe, il suffit d’utiliser le mot-clé `class` comme dans l’example suivant:

```php
<?php

class Article
{

}
```

Une class contient des propriétés et des méthodes.

Les propriétés sont les caractéristiques de notre objet, tandis que les méthodes sont des fonctions qui vont manipuler nos propriétés:

```php
<?php

class Article
{
    // Properties
    private string $title;
    private string $content;
    private string $status;
    private DateTime $created_at;

    // Methods
    public function sayHello(): string
    {
        return "Hello !";
    }

		public function sayBye(): string
		{
				return "Bye !";
		}
}
```

## La visibilité

Vous avez pu remarquer de nouveaux mots-clés:

- `private`
- `public`

C’est ce qu’on appel la visibilité (visibility).

<aside>
💡 Documentation PHP:
La visibilité d'une propriété, d'une méthode ou une constante peut être définie en préfixant sa déclaration avec un mot-clé : `public`, `protected`, ou `private`. 
Les éléments déclarés comme publics sont accessibles partout. L'accès aux éléments protégés est limité à la classe elle-même, ainsi qu'aux classes qui en héritent et parente. L'accès aux éléments privés est uniquement réservé à la classe qui les a définis.

</aside>

Pour tester la visiblité vous pouvez utiliser le code suivant:

```php
<?php

class Visibility
{
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';

    public function printHello()
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

$obj = new Visibility();
echo $obj->public; // Fonctionne
echo $obj->protected; // Erreur fatale
echo $obj->private; // Erreur fatale
$obj->printHello(); // Affiche Public, Protected et Private
```

## L’instanciation

Maintenant que notre objet est créé, il faut l’instancier pour pouvoir l’utiliser.

```php
<?php
require 'Article.php';

$article = new Article();
var_dump($article);
```

Nous pouvons voir ce que `var_dump($article)` nous renvoi.
Il n’y a pas d’erreur mais nous voyons que nos propriétés sont uninitialized, nous n’avons pas défini de valeurs à nos propriétés.

## Initialisation des propriétés

Ils existe plusieurs manières pour initialiser nos propriétés.

### Valeur par défaut

Nous pouvons ajouter une valeur directement à la suite de la déclaration d’une propriété:

```php
//...

private string $status = 'not_published';

//...
```

### Constructeur (constructor)

Le constructor permet d’initialiser une ou plusieurs propriétés à l’instanciation de notre objet:

```php
//...

public function __construct(string $title, string $content)
{
	$this->title = $title;
	$this->content = $content;
}

//...
```

<aside>
💡 Le mot-clé `$this` permet d’accéder aux propriétés et méthodes de notre class, il s’utilise seulement à l’intérieur d’une class.
La flèche `->` permet d’aller chercher la propriété ou la méthode à appeler, elle s’utilise à l’intérieur et à l’extérieur d’une class.

</aside>

```php
//...

$article = new Article("Mon titre", "Mon contenu");

//...
```

Depuis php 8 nous pouvons déclarer les propriétés en même temps que le constructeur:

```php
//...

// Properties
    private string $status = "not_published";
    private DateTime $created_at;

    public function __construct(
        private string $title, private string $content
    )
    {
				$this->created_at = new DateTime('now', new DateTimeZone('Europe/Paris'));
    }

//...
```

## Accesseur et mutateur

Lorsque nos propriétés sont `private` nous ne pouvons les utiliser à l’extérieur de notre class, pour palier certains diront qu’il faut passer les propriétés `private` à `public` …
Et bien non, nous mettons les propriétés `private` pour garder une certaine sécurité et maintenabilité de notre objet Article. Pour accéder à nos propriétés nous allons créer des accesseurs en `public`.

### Accesseur (accessor)

Un accesseur commence toujours par “get”:

```php
//...

public function getTitle()
{
		return $this->title;
}

public function getContent()
{
		return $this->content;
}

//...
```

```php
$article = new Article("Mon titre", "Mon contenu");
echo $article->getTitle(); // Mon titre
echo $article->getContent(); // Mon contenu
```

### Mutateur (mutator)

Un mutateur commence toujours par “set”:

```php
//...

public function setTitle(string $title)
{
		$this->title = $title;		
}

//...
```

```php
//...

$article = new Article("Mon titre", "Mon contenu");
echo $article->getTitle(); // Mon titre
echo $article->getContent(); // Mon contenu

$article->setTitle("Mon nouveau titre");
echo $article->getTitle(); // Mon nouveau titre

//...
```
