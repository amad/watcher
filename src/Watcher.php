<?php

namespace Stunt\Watcher;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

/**
 * @author Ahmad Samiei
 */
class Watcher
{
    /**
     * Command to run on file changes
     *
     * @var string
     */
    private $command;

    /**
     * Specified file(s)
     *
     * @var array
     */
    private $files;

    /**
     * Sleep between each shift to check files
     *
     * @var integer
     */
    private $sleep;

    /**
     * Timestamp for comparison
     *
     * @var integer
     */
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

    /**
     * Watch specified files and trigger command on file change
     *
     * @param  boolean $runOnce
     */
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
     * Check if any file modified or new file created
     *
     * @param  \SplFileInfo  $file
     * @return boolean
     */
    private function changed(\SplFileInfo $file)
    {
        return filemtime($file->getRealPath()) > $this->timestamp;
    }
}
