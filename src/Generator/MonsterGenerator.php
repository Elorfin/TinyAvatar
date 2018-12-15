<?php

namespace Elorfin\TinyAvatar\Generator;

/**
 * Class MonsterGenerator.
 *
 * Generation rules :
 *      | 1f 38 70 |  be  |   27  |  4f  |    6c    | 49 b3 e3 1a 0c 67 28 95 7f
 *      |   color  | head | mouth | eyes | special  |
 *
 *   - 0, 1, 2 : primary color
 *   - 1, 2, 0 : secondary color
 *   - 3       : head type
 *   - 4       : mouth
 *   - 5       : eyes
 *   - 6       : special
 */
class MonsterGenerator extends AbstractAssetGenerator
{
    private $seed;
    private $primaryColor;
    private $secondaryColor;

    protected function getAssetPath(): string
    {
        return 'monster';
    }

    public function generate(string $seed): string
    {
        // convert hash seed into an array of 16 hex numbers for easy manipulation
        $this->seed = str_split($seed, 2);

        $this->calculateColors();

        // create base svg
        $svgTemplate = new \SimpleXMLElement($this->getAsset('body'));

        // append special

        // append head
        $head = new \SimpleXMLElement($this->getAsset('heads/'.hexdec($this->seed[3])));
        if (0 !== $head->count()) {
            $this->append($svgTemplate, $head->children()[0]);
        }

        // append eyes
        $eyes = new \SimpleXMLElement($this->getAsset('eyes/'.hexdec($this->seed[4])));
        if (0 !== $eyes->count()) {
            $this->append($svgTemplate, $eyes->children()[0]);
        }

        // append mouth

        // set colors to generated monster
        $this->colorize($svgTemplate);

        return $svgTemplate->asXML();
    }

    private function calculateColors()
    {
        // calculate primary color from 6 first chars
        $this->primaryColor = $this->seed[0].$this->seed[1].$this->seed[2];

        // move first HEX to the end to get a complementary color
        //$this->secondaryColor = $this->seed[2].$this->seed[0].$this->seed[1];
        $this->secondaryColor = $this->seed[3].$this->seed[4].$this->seed[5];
    }

    private function append(\SimpleXMLElement $parent, \SimpleXMLElement $toAppend)
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

    private function colorize(\SimpleXMLElement $toColorize)
    {
        foreach ($toColorize->attributes() as $attrName => $attrValue) {
            if ('class' === $attrName) {
                if (false !== strpos($attrValue, 'primary-fill')) {
                    $toColorize->addAttribute('fill', "#{$this->primaryColor}");
                } else if (false !== strpos($attrValue, 'secondary-fill')) {
                    $toColorize->addAttribute('fill', "#{$this->secondaryColor}");
                }

                if (false !== strpos($attrValue, 'primary-stroke')) {
                    $toColorize->addAttribute('stroke', "#{$this->primaryColor}");
                } else if (false !== strpos($attrValue, 'secondary-stroke')) {
                    $toColorize->addAttribute('stroke', "#{$this->secondaryColor}");
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
