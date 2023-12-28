<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ApiCurrencies extends Command
{
    const COMMAND_NAME = 'api:currencies';

    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription('Currencies from ECB');
 
        $this->addArgument('baseCurrency',InputArgument::REQUIRED,'USD');
        $this->addArgument('exchangeCurrency',InputArgument::REQUIRED,'EUR');
        $this->addArgument('startPeriod',InputArgument::REQUIRED,date('Y-m-d'));
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(['','<info>Downloading currencies:</>','']);

        $url = sprintf('https://data-api.ecb.europa.eu/service/data/EXR/D.%s.%s.SP00.A?startPeriod=%s&endPeriod=%s',
            $input->getArgument('baseCurrency'),$input->getArgument('exchangeCurrency'),$input->getArgument('startPeriod'),date('Y-m-d')
        );

        $output->writeln($url);

        $currencies = file_get_contents($url);
        var_dump($currencies);

        return 0;
    }
}