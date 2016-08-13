<?php

namespace Amad\Watcher\Console;

use Amad\Watcher\Watcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WatcherCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('watcher')
            ->setDescription(WATCHER_DESCRIPTION)
            ->addOption('sleep', 's', InputOption::VALUE_REQUIRED, 'Sleep between each shift', WATCHER_SLEEP)
            ->addOption('run-once', null, InputOption::VALUE_NONE, 'Stop watcher after first event')
            ->addArgument('command', InputArgument::REQUIRED, 'Arbitrary command to run on file changes')
            ->addArgument('file', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Files to watch for changes');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $watcher = new Watcher($this->command, $this->files, $this->sleep);
        $watcher->watch($this->runOnce);
    }

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->command = $input->getArgument('command');
        $this->files = $input->getArgument('file');
        $this->sleep = $input->getOption('sleep');
        $this->runOnce = $input->getOption('run-once');
    }
}
