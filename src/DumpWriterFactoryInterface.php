<?php

namespace Imponeer\ProjectCachedCodeGeneratorFromComposerJSONDataBase;

/**
 * Interface that is used to create DumpWriterFactory classes
 *
 * @package Imponeer\ProjectCachedCodeGeneratorFromComposerJSONDataBase
 */
interface DumpWriterFactoryInterface
{
    /**
     * Add config
     *
     * @param array[] $extra Extra part of config
     */
    public function addConfig(array $extra): void;
}