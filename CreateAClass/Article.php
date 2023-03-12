<?php

class Article
{
    // Properties
    private string $status = "not_published";
    private DateTime $created_at;

    public function __construct(
        private string $title, private string $content
    )
    {
        $this->created_at = new DateTime('now', new DateTimeZone('Europe/Paris'));
    }

    // Methods
    public function sayHello(): string
    {
        return "Hello !";
    }

    public function sayBye(): string
    {
        return "Bye !";
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }
}