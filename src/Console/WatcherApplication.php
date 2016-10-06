<?php

namespace Stunt\Watcher\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

class WatcherApplication extends Application
{
    /**
     * {@inheritdoc}
     */
    public function __construct($version)
    {
        parent::__construct('watcher', $version);
    }

    /**
     * {@inheritdoc}
     */
    protected function getCommandName(InputInterface $input)
    {
        return 'watcher';
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = new WatcherCommand();

        return $defaultCommands;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefinition()
    {
        return new InputDefinition([
            new InputOption('--help', '-h', InputOption::VALUE_NONE, 'Display this help message.'),
            new InputOption('--version', '-V', InputOption::VALUE_NONE, 'Display this behat version.'),
        ]);
    }
}
