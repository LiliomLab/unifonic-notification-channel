<?php

namespace Multicaret\Notifications\Messages;

class UnifonicMessage
{
    /**
     * The message content.
     *
     * @var string
     */
    public $content;

    /**
     * The Sender ID the message should be sent from.
     *
     * @var string
     */
    public $senderID;

    /**
     * The message type.
     *
     * @var string
     */
    public $type = 'text';

    /**
     * Create a new message instance.
     *
     * @param  string $content
     *
     * @return void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param  string $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set Sender ID the message should be sent from.
     *
     * @param $senderID
     *
     * @return $this
     */
    public function senderID($senderID)
    {
        $this->senderID = $senderID;

        return $this;
    }

    /**
     * Set the message type.
     *
     * @return $this
     */
    public function unicode()
    {
        $this->type = 'unicode';

        return $this;
    }
}
