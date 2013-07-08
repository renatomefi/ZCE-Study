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
    
    /**
     * Return array of question options
     * 
     * @return array
     */
    public function getOptions($correct = false)
    {
        
        $options = array();
        
        $i = 0;
        foreach ($this->_options as $o) {
            if (FALSE === $correct || $o['correct'] === true) {
                $options[$i] = $o['value'];
            }
            $i++;
        }
        
        return $options;
    }

    /**
     * Set all options once
     * 
     * @param array $options
     * @throws \Exception
     */
    protected function setOptions($options)
    {
        if (!is_array($options))
            throw new \Exception('$options must be an aray');
        
        $this->_options = $options;
    }

    /**
     * Add an option to the question
     * 
     * @param string $option
     * @param bool $correct
     * @return \ZCE\Certifications\Question\MultipleChoice
     * @throws \Exception
     */
    protected function addOption($option, $correct = null)
    {
        if (is_null($correct) || !is_bool($correct))
            throw new \Exception('$correct must be a boolean');
        
        $this->_options[] = array(
            'value' => (string) $option, 'correct' => $correct
        );
        
        return $this;
    }
    
    /**
     * Filter users ansewer for multiple choice
     * Removes anything but alpha
     * Also returns an array with invalid options
     * 
     * @param string $answer
     * @param array $filter
     * @return array
     */
    protected function _filterAnswer($answer, Array $filter = array())
    {
        $aArray = str_split(strtoupper($answer));
        
        $answer = array();
        $invalid = array();
        
        // Removes anything tha is not alpha
        // fill an array with valid and invalid chars
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
    
    /**
     * Validates user's answer
     * Optional filter (pre validates)
     * 
     * @param string $answer
     * @param array $map
     * @param array $filter
     * @return boolean
     */
    public function isValid($answer, $map = array(), $filter = array())
    {
        $answerfiltered =  $this->_filterAnswer($answer, $filter);
        $answerKeys = array_intersect_key(
            $map, array_flip($answerfiltered['valid'])
        );
        
        $answerCorrect = array_keys($this->getOptions(TRUE));
        
        $answerMatch = array_intersect(array_values($answerCorrect), array_values($answerKeys));
        
        \Zend\Debug\Debug::dump(array_values($answerCorrect));
        \Zend\Debug\Debug::dump(array_values($answerKeys));
        \Zend\Debug\Debug::dump(array_values($answerMatch));
        return true;
    }
}