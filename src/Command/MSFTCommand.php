<?php

declare(strict_types=1);

namespace App\Command;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\Service\Attribute\Required;

class MSFTCommand extends Command
{
    protected EntityManagerInterface $em;
    
    public function __construct(
        string $name = null
    ) {
        parent::__construct($name);
    }

    public function getName(): string
    {
        return 'msft:research';
    }
    
    // the command description shown when running "php bin/console list"
    protected static $defaultDescription = 'Работа с майкрософт';

    protected function configure(): void
    {
        $this
            // the command help shown when running the command with the "--help" option
            ->setHelp('Handle microsoft company')
            ;
    }

    public function setBaseServices(
        EntityManagerInterface $em
    ): void
    {
        $this->em = $em;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output -> writeln([
            'Look info'
        ]);

        return Command::SUCCESS;
    }
}
