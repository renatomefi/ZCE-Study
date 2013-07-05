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

namespace ZCE\Ceritications;

/**
 * Question Abstract class
 *
 * @author Renato Mendes Figueiredo <zce-project@renatomefi.com.br>
 */
abstract class QuestionAbstract
{

    /**
     * Query text
     * 
     * @var string
     */
    protected $query;

    /**
     * Answer of the current question
     * It can be an array or an String
     * 
     * @var array|String
     */
    protected $answer;

    /**
     * The reason of the answer
     * 
     * @var String 
     */
    protected $explanation;

    /**
     * If there is a class with example, put it here
     * 
     * @var ZCE\Ceritications\Question\ExampleAbstract
     */
    protected $exampleClass;

    /**
     * Put a link to documentation or another source that can solve
     * the answer questions
     * 
     * @var String 
     */
    protected $see;

    /**
     * Return query text
     * 
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    protected function setQuery($query)
    {
        $this->query = (string) $query;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    protected function setAnswer($answer)
    {
        if (!is_array($answer))
            throw new \Exception(__NAMESPACE__ . __CLASS__ . ' must be aray.');
        
        $this->answer = $answer;
    }
    
    protected function addAnswer(String $answer, $correct = null)
    {
        if (is_null($correct) || !is_bool($correct))
            throw new \Exception(__NAMESPACE__ . __CLASS__ . __FUNCTION__ . '($correct) must be boolean');
            
        $this->answer[$answer] = $correct;
    }

    public function getExplanation()
    {
        return $this->explanation;
    }

    protected function setExplanation($explanation)
    {
        $this->explanation = $explanation;
    }

    public function getExampleClass()
    {
        return $this->exampleClass;
    }

    protected function setExampleClass(Question\ExampleAbstract $exampleClass)
    {
        $this->exampleClass = $exampleClass;
    }

    public function getSee()
    {
        return $this->see;
    }

    protected function setSee($see)
    {
        $this->see = $see;
    }

}