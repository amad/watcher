# Watcher

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/amad/watcher/master/LICENSE)
[![Latest Stable Version](https://img.shields.io/packagist/v/amad/watcher.svg?style=flat-square)](https://packagist.org/packages/amad/watcher)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.5.9-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://travis-ci.org/amad/watcher.svg?branch=master)](https://travis-ci.org/amad/watcher)
[![StyleCI](https://styleci.io/repos/65620231/shield?branch=master)](https://styleci.io/repos/65620231)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/766f28cd-7811-4b53-b2fb-974332d59023/mini.png)](https://insight.sensiolabs.com/projects/766f28cd-7811-4b53-b2fb-974332d59023)

Watcher is simple tools to run your arbitrary command on file changes.

```
$ watcher <command> <file> (<file>)...
```

## Installation

```
$ composer global require amad/watcher
```

## Example Usage

```
$ watcher phpunit ./
```
```
$ watcher 'clear && phpunit -c phpunit.xml' src/ tests/
```
```
$ watcher 'docker run unitests' src/ tests/
```
```
$ watcher 'docker exec project-container behat' src/ tests/features/
```
