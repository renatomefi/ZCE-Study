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

namespace ZCE\Certifications\PHP5;

use ZCE\Certifications\Question\MultipleChoice;

/**
 * Description of Q1
 *
 * @author Renato Mendes Figueiredo <zce-project@renatomefi.com.br>
 */
class Q1 extends MultipleChoice
{

    protected function build()
    {
        $this->setQuery('Quanto é 1+1?');
        
        $this
                ->addOption('2', true)
                ->addOption('3', false)
                ->addOption('4', false)
                ->addOption('0', false);
    }

    public function isValid()
    {
        return true;
    }

}