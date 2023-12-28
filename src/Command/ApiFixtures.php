<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Entity\ApiFixture;

class ApiFixtures extends Command
{
    const COMMAND_NAME = 'api:fixtures';
    const API_FIXTURES_DIR =  '/src/DataFixtures';

    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName(static::COMMAND_NAME)->setDescription('Load api data fixtures');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(['','<info>Executing API fixtures:</>','']);

        $projectDir = $this->getApplication()->getKernel()->getProjectDir();

        foreach ( glob( $projectDir . self::API_FIXTURES_DIR . "/*.php" ) as $filePath ) 
        {
            $this->executeFixture($output,$this->resolveNamespaceFromFilePath($filePath));
        }

        $output->writeln(['']);

        return 0;
    }

    protected function executeFixture($output,$fixture)
    {
        if ( ! $this->em->getRepository(ApiFixture::class)->findOneByFixture($fixture) ) {
            
            $output->writeln(['<info> [+] '. $fixture . '</>']);
            
            try {
                
                $obj = new $fixture(); $obj->load($this->em);    

                $apiFixture = new ApiFixture([
                    'fixture' => $fixture,
                    'loadedAt' => new \Datetime()
                ]);
    
                $this->em->persist($apiFixture);
                $this->em->flush();
    
            } catch (\Exception $e){
                $output->writeln(['','<error>'. $e->getMessage() . '</>','']);
            }            
        }
    }

    protected function resolveNamespaceFromFilePath($filePath)
    {
        return 'App\\DataFixtures\\' . rtrim(basename($filePath),".php");
    }
}