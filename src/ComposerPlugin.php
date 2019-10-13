<?php

namespace Imponeer\ProjectComposerCacheBasedRegistratorPluginBase;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Plugin class use for base of composer plugins
 *
 * @package Imponeer\ProjectComposerCacheBasedRegistratorPluginBase
 */
abstract class ComposerPlugin implements PluginInterface, EventSubscriberInterface
{

    /**
     * Current composer instance
     *
     * @var Composer
     */
    protected $composer;

    /**
     * Linked Input-Output interface
     *
     * @var IOInterface
     */
    protected $io;

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'post-autoload-dump' => [
                'afterAutoloadDump'
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    /**
     * Execute event after autoload dump was finished
     *
     * This method actual will create dump cache
     */
    public function afterAutoloadDump()
    {
        $dumpWriterClass = $this->getDumpWriterClass();
        require_once realpath(__DIR__ . '/../../../' . "autoload.php");
        $factory = new $dumpWriterClass();
        if (!($factory instanceof DumpWriterFactoryInterface)) {
            throw new DumpWriterFactoryNotImplementsDumpWriterFactoryInterfaceException();
        }
        $factory->addConfig(
            $this->composer->getPackage()->getExtra()
        );
        $dumpWriter = $factory->create();
        if ($dumpWriter === null) {
            $this->io->write(
                sprintf(
                    '<info>%s</info>',
                    $this->getCannotCreateDumpWriterInstanceMessage()
                ),
                true,
                IOInterface::NORMAL
            );
            return;
        }
        $this->io->write(
            sprintf(
                '<info>%s</info>',
                $this->getUpdatingCacheMessage()
            ),
            true,
            IOInterface::NORMAL
        );
        if (!$dumpWriter->writeToFile()) {
            $this->io->writeError($this->getFailToWriteDumpMessage());
        }
    }

    /**
     * Gets dump writer class
     *
     * @return string
     */
    protected abstract function getDumpWriterClass();

    /**
     * Get message when can't create dump writer instance
     *
     * @return string
     */
    protected abstract function getCannotCreateDumpWriterInstanceMessage();

    /**
     * Get message when updating cache
     *
     * @return string
     */
    protected abstract function getUpdatingCacheMessage();

    /**
     * Get message when can't write cache file
     *
     * @return string
     */
    protected abstract function getFailToWriteDumpMessage();
}