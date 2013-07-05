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

namespace ZCE\App;

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
    private $_certs = array();

    /**
     * Populate $certs
     */
    public function __construct()
    {
        $this->_certs = array(
            'PHP5',
            'ZF1'
        );
    }

    /**
     * Return certifications type
     * 
     * @return array
     */
    public function toArray()
    {
        return (array) $this->_certs;
    }

    /**
     * Prints certifications type in text mode
     * 
     * @return string
     */
    public function __toString()
    {
        return '(' . implode(' | ', $this->_certs) . ')';
    }

}