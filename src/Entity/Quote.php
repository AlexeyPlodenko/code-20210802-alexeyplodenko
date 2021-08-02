<?php

namespace App\Entity;

class Quote
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $siteId;

    /**
     * @var int
     */
    public $destinationId;

    /**
     * @var string
     */
    public $dateQuoted;

    /**
     * @param int $id
     * @param int $siteId
     * @param int $destinationId
     * @param string $dateQuoted
     */
    public function __construct($id, $siteId, $destinationId, $dateQuoted)
    {
        $this->id = $id;
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
        $this->dateQuoted = $dateQuoted;
    }

    /**
     * @param Quote $quote
     *
     * @return string
     */
    public static function renderHtml(Quote $quote)
    {
        return '<p>' . $quote->id . '</p>';
    }

    /**
     * @param Quote $quote
     *
     * @return string
     */
    public static function renderText(Quote $quote)
    {
        return (string) $quote->id;
    }
}
