<?php

namespace Stunt\Watcher;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

class Watcher
{
    /** @var string */
    private $command;
    /** @var array */
    private $files;
    /** @var integer */
    private $sleep;
    /** @var integer */
    private $timestamp;

    /**
     * @param string  $command
     * @param array   $files
     * @param integer $sleep
     */
    public function __construct($command, array $files, $sleep)
    {
        $this->command = $command;
        $this->files = $files;
        $this->sleep = $sleep;
        $this->timestamp = time();
    }

    public function watch($runOnce = false)
    {
        while (true) {
            foreach ($this->getFiles() as $file) {
                if ($this->changed($file)) {
                    $this->trigger();
                    if ($runOnce) {
                        return;
                    }
                    break;
                }
            }
            sleep($this->sleep);
        }
    }

    /**
     * Update timestamp and trigger command
     */
    private function trigger()
    {
        $this->timestamp = time();

        $process = new Process($this->command);
        $process->setTty(true);
        $process->run();
        print $process->getOutput();
    }

    /**
     * @return Finder
     */
    private function getFiles()
    {
        return (new Finder)->ignoreUnreadableDirs()->files()->in($this->files);
    }

    /**
     * Compare file mtime against timestamp
     *
     * @param  \SplFileInfo  $file
     * @return boolean
     */
    private function changed(\SplFileInfo $file)
    {
        return filemtime($file->getRealPath()) > $this->timestamp;
    }
}
