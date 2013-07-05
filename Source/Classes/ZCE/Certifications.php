<?php

/*
 * This file is part of the ZCE Study
 *
 * (c) Renato Mendes Figueiredo <zce-project@renatomefi.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * More information at: https://github.com/renatomefidf/ZCE-Study
 */

namespace ZCE;

/**
 * Zend Certifications available in the project
 *
 * @author Renato Mendes Figueiredo <zce-project@renatomefi.com.br>
 */
class Certifications
{

    /**
     * Certifications
     * More at: http://www.zend.com/services/certification/
     * 
     * @var array
     */
    private $certs = array();

    /**
     * Populate $certs
     */
    public function __construct()
    {
        $this->certs = array(
            'PHP5',
            'ZF1'
        );
    }

    /**
     * 
     * @return type
     */
    public function toArray()
    {
        return (array) $this->certs;
    }

    /**
     * 
     * @return type
     */
    public function __toString()
    {
        return '(' . implode(' | ', $this->certs) . ')';
    }

}