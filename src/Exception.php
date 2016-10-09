<?php

namespace JeroenDesloovere\VolleyAdmin2;

class Exception extends \Exception
{
    public function getMessage(\Exception $e)
    {
        return $e->getMessage();
    }
}
