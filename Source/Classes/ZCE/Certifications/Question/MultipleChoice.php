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

namespace ZCE\Certifications\Question;

use ZCE\Certifications\QuestionAbstract;

/**
 * Description of MultipleChoiceAbstract
 *
 * @author Renato Mendes Figueiredo <zce-project@renatomefi.com.br>
 */
abstract class MultipleChoice extends QuestionAbstract
{
    /**
     * Question options
     * 
     * @var array
     */
    protected $_options;
    
    public function getOptions()
    {
        $options = array();
        foreach ($this->_options as $o) {
            $options[] = $o['value'];
        }
        return $options;
    }

    protected function setOptions($options)
    {
        if (!is_array($options))
            throw new \Exception('$options must be an aray');
        
        $this->_options = $options;
    }

    protected function addOption($option, $correct = null)
    {
        if (is_null($correct) || !is_bool($correct))
            throw new \Exception('$correct must be a boolean');
        
        $this->_options[] = array(
            'value' => (string) $option, 'correct' => $correct
        );
        
        return $this;
    }
    
    public function _filterAnswer($a, Array $filter = array())
    {
        $aArray = str_split(strtoupper($a));
        
        $answer = array();
        $invalid = array();
        
        foreach ($aArray as $v) {
            if (ctype_alpha($v)) {
                if (in_array($v, $filter) || empty($filter)) {
                    $answer[] = $v;
                } else {
                    $invalid[] = $v;
                }
            }
        }
        
        return array('valid' => $answer, 'invalid' => $invalid);
    }
    
    public function isValid($answer)
    {
        \Zend\Debug\Debug::dump($this->_filterAnswer($answer, $this->getOptions()));
        return true;
    }
}