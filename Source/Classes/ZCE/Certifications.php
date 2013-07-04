<?php

namespace ZCE;

class Certifications
{

    private $certs = array();

    public function __construct()
    {
        $this->certs = array(
            'PHP5',
            'ZF'
        );
    }

    public function toArray()
    {
        return (array) $this->certs;
    }

    public function __toString()
    {
        return '(' . implode(' | ', $this->certs) . ')';
    }

}