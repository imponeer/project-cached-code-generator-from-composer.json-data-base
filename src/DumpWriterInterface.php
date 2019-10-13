<?php

namespace Imponeer\ProjectComposerCacheBasedRegistratorPluginBase;

/**
 * Interface to use for creating DumpWriter
 *
 * @package Imponeer\ProjectComposerCacheBasedRegistratorPluginBase
 */
interface DumpWriterInterface
{

    /**
     * Constructor
     *
     * @param string $filename Filename to write
     */
    public function __construct($filename);

    /**
     * Write existing service configuration to file
     *
     * @return bool
     */
    public function writeToFile();
}