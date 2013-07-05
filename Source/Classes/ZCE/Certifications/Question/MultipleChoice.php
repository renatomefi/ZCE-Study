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
        return $this->_options;
    }

    protected function setOptions($options)
    {
        if (!is_array($options))
            throw new \Exception('$options must be aray');
        
        $this->_options = $options;
    }

    protected function addOption($option, $correct = null)
    {
        if (is_null($correct) || !is_bool($correct))
            throw new \Exception('$correct must be a boolean');
        
        $this->_options[] = (string) $option;
        
        return $this;
    }
}