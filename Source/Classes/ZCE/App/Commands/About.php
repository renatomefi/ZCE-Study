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

namespace ZCE\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CLI Command about the Project
 *
 * @author Renato Mendes Figueiredo <zce-project@renatomefi.com.br>
 */
class About extends Command
{

    /**
     * @see Symfony\Component\Console\Command\Command::configure
     */
    protected function configure()
    {
        $this
                ->setName('about')
                ->setDescription('About this system')
                ->addOption(
                        'all', 'a', InputOption::VALUE_OPTIONAL, 'List this project\'s authors', true
                )
                ->addOption(
                        'authors', 'A', InputOption::VALUE_NONE, 'List this project\'s authors'
                )
                ->addOption(
                        'info', 'i', InputOption::VALUE_NONE, 'Project\'s info'
                )
                ->addOption(
                        'github', 'g', InputOption::VALUE_NONE, 'This project\'s GitHub'
                )
                ->addOption(
                        'zend', 'z', InputOption::VALUE_NONE, 'Zend Certification'
                )
                ->addOption(
                        'usage', 'u', InputOption::VALUE_NONE, 'Script\'s usage'
                )
        ;
    }

    /**
     * @see Symfony\Component\Console\Command\Command::execute
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<question>About</question> <info>' . \ZCE\App\Project::NAME . '</info>');
        $output->writeln('');

        $aboutClass = new \ZCE\App\About();

        if ($input->getOption('all')) {
            $authors = true;
            $github = true;
            $info = true;
            $zend = true;
            $usage = true;
        } else {
            $authors = $input->getOption('authors');
            $github = $input->getOption('github');
            $info = $input->getOption('info');
            $zend = $input->getOption('zend');
            $usage = $input->getOption('usage');
        }

        if (true === $authors) {
            $output->writeln('<comment>Authors</comment>');

            $table = $this->getHelperSet()->get('table');
            $aboutClass->authors($table);

            $table->render($output);
            $output->writeln('');
        }

        if (true === $github) {
            $output->writeln('<comment>GitHub</comment>');
            $aboutClass->github($output);
            $output->writeln('');
        }

        if (true === $info) {
            $output->writeln('<comment>Info</comment>');
            $aboutClass->github($output);
            $output->writeln('');
        }

        if (true === $usage) {
            $output->writeln('<comment>Usage</comment>');
            $aboutClass->github($output);
            $output->writeln('');
        }

        if (true === $zend) {
            $output->writeln('<comment>Zend</comment>');
            $aboutClass->github($output);
            $output->writeln('');
        }
    }

}