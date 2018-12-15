<?php

namespace Elorfin\TinyAvatar\Generator;

/**
 * Base class for generators based on SVG assets.
 */
abstract class AbstractAssetGenerator extends AbstractGenerator
{
    abstract protected function getAssetPath(): string;

    protected function getAsset(string $name): string
    {
        $filePath = __DIR__.'/../../assets/'.$this->getAssetPath().'/'.$name.'.svg';
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException(
                sprintf('Cannot find asset named "%s" (expected to be found in: %s).', $name, $filePath)
            );
        }

        return file_get_contents($filePath);
    }

    protected function pickAsset($part, $number): string
    {

    }
}
