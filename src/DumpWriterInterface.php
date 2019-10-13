<?php

namespace Imponeer\ProjectCachedCodeGeneratorFromComposerJSONDataBase;

/**
 * Interface to use for creating DumpWriter
 *
 * @package Imponeer\ProjectCachedCodeGeneratorFromComposerJSONDataBase
 */
interface DumpWriterInterface
{

    /**
     * Constructor
     *
     * @param string $filename Filename to write
     */
    public function __construct(string $filename);

    /**
     * Write existing service configuration to file
     *
     * @return bool
     */
    public function writeToFile(): bool;
}