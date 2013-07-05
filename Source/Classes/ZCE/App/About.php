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

use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Holds and display infos about this Project
 *
 * @author Renato Mendes Figueiredo <zce-project@renatomefi.com.br>
 */
class About
{

    /**
     * Set TableHelper properties with Authors
     * 
     * @param \Symfony\Component\Console\Helper\TableHelper $table
     */
    public function authors(TableHelper &$table)
    {

        $fields = array('Name', 'Hands on', 'Link', 'E-mail');
        $authors = array(
            array('Renato Mendes Figueiredo', 'First Developer',
                'http://br.linkedin.com/in/renatomefidf',
                'zce-project@renatomefi.com.br'),
        );

        $table
                ->setHeaders($fields)
                ->setRows($authors)
        ;
    }

    /**
     * Apeend to output informations about GitHub in this project
     * 
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function github(OutputInterface &$output)
    {
        $output->writeln('<info>This project is hosted at GitHub</info>');
        $output->writeln('<info>You can access this via:</info> ' . Project::GITHUB);
        $output->writeln('<info>I\'ll be very happy if you wanna contribute with me!</info> <bg=blue;options=bold>Fork it</bg=blue;options=bold>');
    }

    /**
     * Apeend to output informations
     * 
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function info(OutputInterface &$output)
    {
        $output->writeln('<info>With ZCE-Study you can asware tons of questions about Zend Certifications, including ZCE and ZF.</info>');
    }

    /**
     * Apeend to output informations about usage in this project
     * 
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function usage(OutputInterface &$output)
    {
        $output->writeln('1. <info>Download the `project` and execute `zce.php` at `Source` folder.</info>');
        $output->writeln('``` sh');
        $output->writeln('<options=bold>$</options=bold> cd ' . SOURCE_PATH);
        $output->writeln('<options=bold>$</options=bold> chmod +x zce.php');
        $output->writeln('<options=bold>$</options=bold> ./zce.php help');
        $output->writeln('```');
        $output->writeln('2. <info>After use help option it will show you the usage manual.</info>');
    }

}