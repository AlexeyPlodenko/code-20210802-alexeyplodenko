<?php

namespace App\Entity;

class Template
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $content;

    /**
     * @param int $id
     * @param string $subject
     * @param string $content
     */
    public function __construct($id, $subject, $content)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->content = $content;
    }
}
