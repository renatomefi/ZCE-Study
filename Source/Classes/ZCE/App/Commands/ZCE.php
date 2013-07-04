<?php

namespace ZCE\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use ZCE\Certifications;

class ZCE extends Command
{

    protected function configure()
    {
        $certs = new Certifications();
        
        $this
                ->setName('zce')
                ->setDescription('ZCE PHP5.3 Questions')
                ->addArgument(
                        'certification', InputArgument::OPTIONAL, "Choose Certification $certs"
                )
                ->addArgument(
                        'question', InputArgument::OPTIONAL, 'Show selected question'
                )
                ->addOption(
                        'list', 'l', InputOption::VALUE_NONE, 'Lists current Certification questions'
                )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $certs = new Certifications();
                
        $certsType = $input->getArgument('certification');
        if (!$certsType || !in_array($certsType, $certs->toArray())) {
            $dialog = $this->getHelperSet()->get('dialog');
            $certsType = $dialog->ask($output, "Please, choose a Certification Type $certs: ", null, $certs->toArray());
        }

        if ($input->getOption('list')) {
            $output->writeln("<comment>LISTA</comment>");
            return;
        }

        $qNum = $input->getArgument('question');
        if (!$qNum) {
            $dialog = $this->getHelperSet()->get('dialog');
            $qNum = $dialog->ask($output, 'Please enter the question number: ');
        }

        $text = "ZCE:$certsType Question number $qNum";

        $output->writeln("<info>$text</info>");
    }

}