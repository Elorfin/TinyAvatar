<?php

namespace Elorfin\TinyAvatar\Generator;

/**
 * Class MonsterGenerator.
 *
 * Generation rules (seed is a MD5 hash of 32 chars):
 *   - 0-1-2-3-4-5   : primary color
 *   - 6-7-8-9-10-11 : secondary color
 *   - 12-13         : head
 *   - 14-15         : eyes
 *   - 16-17         : mouth
 *   - 18-19         : special
 *   - 20            : special v-mirror
 */
class MonsterGenerator extends AbstractAssetGenerator
{
    protected function getAssetPath(): string
    {
        return __DIR__.'/../../assets/monster';
    }

    public function generate(): string
    {
        $this->svg->addAttribute('shape-rendering', 'geometricPrecision');

        // append body
        $body = new \SimpleXMLElement($this->getAsset('body'));
        if (0 !== $body->count()) {
            $this->append($this->svg, $body->children()[0]);
        }

        // append special

        // append head
        $head = new \SimpleXMLElement($this->getAsset('heads/'.$this->getAssetNum(substr($this->seed, 6, 2))));
        if (0 !== $head->count()) {
            $this->append($this->svg, $head->children()[0]);
        }

        // append eyes
        $eyes = new \SimpleXMLElement($this->getAsset('eyes/'.$this->getAssetNum(substr($this->seed, 8, 2))));
        if (0 !== $eyes->count()) {
            $this->append($this->svg, $eyes->children()[0]);
        }

        // append mouth
        $mouth = new \SimpleXMLElement($this->getAsset('mouths/'.$this->getAssetNum(substr($this->seed, 10, 2))));
        if (0 !== $mouth->count()) {
            $this->append($this->svg, $mouth->children()[0]);
        }

        // set colors to generated monster
        $this->colorize($this->svg);

        return $this->svg->asXML();
    }

    /**
     * Hex is a value between 0 - 255.
     * We will reduce it to get a value between 0 - 26.
     *
     * @param $hex
     * @return float
     */
    private function getAssetNum($hex)
    {
        return round(hexdec($hex) / 20);
    }
}
