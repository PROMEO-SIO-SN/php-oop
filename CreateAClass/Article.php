<?php

class Article
{
    // Properties
    private string $title;
    private string $content;
    private string $status = "not_published";
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

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }
}