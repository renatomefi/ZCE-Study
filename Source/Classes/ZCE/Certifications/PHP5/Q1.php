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
        $this->setQuery(
            '<?php
            include("xml.inc");
            if(!$dom = domxml_open_mem($xmlstr)) {
            echo "Error while parsing the XML document\n";
            exit;
            }
            $a = ***********
            print_r($a);
            ?>'
        );

        $this
            ->addOption('$dom->root_element();', FALSE)
            ->addOption('$dom->root_node();', FALSE)
            ->addOption('$node->parent_node();', FALSE)
            ->addOption('$dom->document_element();', TRUE);
    }

}