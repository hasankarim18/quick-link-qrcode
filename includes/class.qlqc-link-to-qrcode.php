<?php


class QLQC_LINK_TO_QRCODE
{
    public function __construct()
    {
        add_filter('the_content', [$this, 'link_to_qrcode']);
    }
    function link_to_qrcode($content)
    {
        return $content . "<p> Hello </p>";
    }
}

