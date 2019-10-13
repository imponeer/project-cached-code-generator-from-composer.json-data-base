<?php

namespace Imponeer\ProjectComposerCacheBasedRegistratorPluginBase;

/**
 * Interface that is used to create DumpWriterFactory classes
 *
 * @package Imponeer\ProjectComposerCacheBasedRegistratorPluginBase
 */
interface DumpWriterFactoryInterface
{
    /**
     * Add config
     *
     * @param string $extra Extra part of config
     */
    public function addConfig(array $extra);
}