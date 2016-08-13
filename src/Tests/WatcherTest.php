<?php

namespace Stunt\Watch\Tests;

use Stunt\Watcher\Watcher;

class WatcherTest extends \PHPUnit_Framework_TestCase
{
    private $testDir;

    public function setUp()
    {
        $this->testDir = __DIR__.'/test_dir';
    }

    public function tearDown()
    {
        system('rm -fr '.$this->testDir);
    }

    public function testCreateWatcher()
    {
        $this->assertInstanceOf(Watcher::class, new Watcher('touch flag', ['./'], 3));
    }

    public function testWatcherTriggerCommandOnFileChange()
    {
        $testFile = $this->testDir.'/test';
        $flag = $this->testDir.'/flag';

        mkdir($this->testDir);
        touch($testFile);

        $watcher = new Watcher("touch $flag", [$this->testDir], 3);

        touch($testFile, strtotime('+1min'));

        $watcher->watch(true);

        $this->assertTrue(file_exists($flag));
    }
}
