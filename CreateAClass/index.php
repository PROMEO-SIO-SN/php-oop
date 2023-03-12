<?php
require 'Article.php';

$article = new Article("Mon titre", "Mon contenu");
var_dump($article);

echo '<pre>' , var_dump($article->getTitle()) , '</pre>';
echo '<pre>' , var_dump($article->getContent()) , '</pre>';

$article->setTitle("Mon nouveau titre");
echo '<pre>' , var_dump($article->getTitle()) , '</pre>';

