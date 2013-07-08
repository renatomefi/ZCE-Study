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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use ZCE\App\Certifications;

/**
 * CLI Command ZCE
 *
 * @author Renato Mendes Figueiredo <zce-project@renatomefi.com.br>
 */
class ZCE extends Command
{

    /**
     * Creating the command, later it will be added at Application
     * 
     * @see Symfony\Component\Console\Command\Command::configure
     */
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
                        'list', 'l', InputOption::VALUE_NONE, 'Lists current Certification questions');
    }

    /**
     * Validate inputs
     * 
     * @see Symfony\Component\Console\Command\Command::execute
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cert = $this->_getCert($input, $output);

        $question = $this->_getQuestion($input, $output);
    }

    /**
     * Get Certification from input
     * 
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return type
     * @throws \Exception
     */
    protected function _getCert(InputInterface $input, OutputInterface $output)
    {
        $certs = new Certifications();

        $certsType = $input->getArgument('certification');
        if (!$certsType || !in_array($certsType, $certs->toArray())) {
            $dialog = $this->getHelperSet()->get('dialog');
            $certsType = $dialog->ask(
                $output, "Please, choose a Certification type $certs: ",
                null, $certs->toArray()
            );
        }

        if (!in_array($certsType, $certs->toArray())) {
            $output->writeln('<error>Invalid certification type</error>');
            $this->_getCert($input, $output);
        } else {

            /**
             * @todo Build ZF1 Questions
             */
            if ($certsType == 'ZF1') {
                throw new \Exception('ZF1 certification is under construction');
            }

            return $certsType;
        }
    }

    protected function _getQuestion(InputInterface $input, OutputInterface $output)
    {
        $qCert = $input->getArgument('certification');
        $qNum = $input->getArgument('question');
        
        if (!$qNum) {
            $dialog = $this->getHelperSet()->get('dialog');
            $qNum = $dialog->ask($output, 'Please enter the question number: ');
        }
        
        $ns = "ZCE\\Certifications\\$qCert\\";
        
        $class = $ns . "Q$qNum";
        $qClass = null;
        
        if (class_exists($class)) {
            $qClass = new $class;
        }
        
        if (is_object($qClass) && $qClass instanceof \ZCE\Certifications\QuestionAbstract) {
            $this->_askQuestion($output, $qClass);
        } else {
            $output->writeln('<error>Invalid question number</error>');
            $this->_getQuestion($input, $output);
        }
            
    }
            


    /**
     * Executes certification questions
     * 
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function _askQuestion(OutputInterface $output, \ZCE\Certifications\QuestionAbstract $question)
    {

        $info = $question->getInfo($question);
        $output->writeln(
            '<info>ZCE ' . $info['certification'] . 
            ' Question number ' . $info['question'] . '</info>'
        );
        
        $output->writeln('<comment>' . $question->getQuery() . '</comment>');

        // Associate letters and options keys, al   so shows it!
        $letters = array_slice(range('A', 'Z'), 0, count($question->getOptions()));
        $finalOptions = array();
        $i = 0;
        foreach ($question->getOptions() as $k => $v) {
            $output->writeln($letters[$i] . ') <info>' . $v . '</info>');
            $finalOptions[$letters[$i]] = $k;
            $i++;
        }
        
        $dialog = $this->getHelperSet()->get('dialog');
        $answer = $dialog->ask($output, 'Answer: ', null, $letters);
        
        $question->isValid($answer, $finalOptions, $letters);
    }
    


}