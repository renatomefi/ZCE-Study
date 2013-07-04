<?php

namespace ZCE\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class About extends Command
{

    protected function configure()
    {
        $this
                ->setName('about')
                ->setDescription('About this system')
                ->addOption(
                        'all', 'a', InputOption::VALUE_OPTIONAL, 'List this project\'s authors', false
                )
                ->addOption(
                        'authors', 'A', InputOption::VALUE_NONE, 'List this project\'s authors'
                )
                ->addOption(
                        'github', 'g', InputOption::VALUE_NONE, 'This project\'s GitHub'
                )
                ->addOption(
                        'zend', 'z', InputOption::VALUE_NONE, 'Zend Certification'
                )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<comment>About</comment> <info>' . \ZCE\App\Project::NAME . '</info>');

        if ($input->getOption('all')) {
            $output->writeln("<comment>Authors</comment>");
            $output->writeln("<comment>Github</comment>");
            $output->writeln("<comment>About</comment>");
            $output->writeln("<comment>Zend Certification</comment>");
            return;
        }

        if ($input->getOption('authors')) {
            $output->writeln("<comment>Authors</comment>");
            
            $authorsClass = new \ZCE\App\About();
            $authors = $authorsClass->authors();
            
            $table = $this->getHelperSet()->get('table');
            $table
                    ->setHeaders($authors['fields'])
                    ->setRows($authors['authors'])
            ;
            $table->render($output);
        }
    }

}