<?php

namespace AppBundle\Command;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartUpCommand extends ContainerAwareCommand
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('setup:all')
            ->setDescription('Setup all data for the application.')

        ;
    }

    // php bin/console doctrine:database:drop --force
    // php bin/console doctrine:database:create
    // php bin/console doctrine:schema:update --force
    // php bin/console doctrine:fixtures:load --no-interaction
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('doctrine:database:drop');
        $arguments = [
            '--force'  => true,
        ];
        $greetInput = new ArrayInput($arguments);
        $command->run($greetInput, $output);

        $command = $this->getApplication()->find('doctrine:database:create');
        $arguments = [
        ];
        $greetInput = new ArrayInput($arguments);
        $command->run($greetInput, $output);

        $command = $this->getApplication()->find('doctrine:schema:update');
        $arguments = [
            '--force'  => true,
        ];
        $greetInput = new ArrayInput($arguments);
        $command->run($greetInput, $output);

        $command = $this->getApplication()->find('doctrine:fixtures:load', ['--no-interaction'  => true,]);
        $arguments = [
        ];
        $greetInput = new ArrayInput($arguments);
        $greetInput->setInteractive(false);
        $command->run($greetInput, $output);

    }

}
