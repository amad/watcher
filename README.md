# Watcher

Watcher is simple tools to run your arbitrary command on file changes.

```
$ watcher <command> <file> (<file>)...
```

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/Stunt/watcher/master/LICENSE)
[![Latest Stable Version](https://img.shields.io/packagist/v/stunt/watcher.svg?style=flat-square)](https://packagist.org/packages/stunt/watcher)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.5.9-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://travis-ci.org/Stunt/watcher.svg?branch=master)](https://travis-ci.org/Stunt/watcher)

## Installation

```
$ composer global require stunt/watcher
```

## Example Usage

```
$ bin/watcher phpunit src/ tests/
```
