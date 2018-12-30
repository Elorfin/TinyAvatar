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
        $filePath = $this->getAssetPath().'/'.$name.'.svg';
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException(
                sprintf('Cannot find asset named "%s" (expected to be found in: %s).', $name, $filePath)
            );
        }

        return file_get_contents($filePath);
    }

    protected function append(\SimpleXMLElement $parent, \SimpleXMLElement $toAppend)
    {
        $appended = $parent->addChild($toAppend->getName());

        // grab attributes
        foreach ($toAppend->attributes() as $attrName => $attrValue) {
            $appended->addAttribute($attrName, $attrValue);
        }

        // grab children
        if (0 !== $toAppend->count()) {
            foreach ($toAppend->children() as $child) {
                $this->append($appended, $child);
            }
        }
    }

    protected function colorize(\SimpleXMLElement $toColorize)
    {
        // TODO : remove class attribute after reading it

        foreach ($toColorize->attributes() as $attrName => $attrValue) {
            if ('class' === $attrName) {
                if (false !== strpos($attrValue, 'primary-fill')) {
                    $toColorize->addAttribute('fill', sprintf('rgb(%d, %d, %d)', ...$this->primaryColor));
                } else if (false !== strpos($attrValue, 'secondary-fill')) {
                    $toColorize->addAttribute('fill', sprintf('rgb(%d, %d, %d)', ...$this->secondaryColor));
                }

                if (false !== strpos($attrValue, 'primary-stroke')) {
                    $toColorize->addAttribute('stroke', sprintf('rgb(%d, %d, %d)', ...$this->primaryColor));
                } else if (false !== strpos($attrValue, 'secondary-stroke')) {
                    $toColorize->addAttribute('stroke', sprintf('rgb(%d, %d, %d)', ...$this->secondaryColor));
                }
            }
        }

        // grab children
        if (0 !== $toColorize->count()) {
            foreach ($toColorize->children() as $child) {
                $this->colorize($child);
            }
        }
    }
}
