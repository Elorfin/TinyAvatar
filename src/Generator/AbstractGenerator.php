<?php

namespace Elorfin\TinyAvatar\Generator;

abstract class AbstractGenerator
{
    /**
     * The seed which will be used to generate image.
     * It is a MD5 hash of 32 chars.
     *
     * @var array
     */
    protected $seed;

    /**
     * @var \SimpleXMLElement
     */
    protected $svg;

    protected $primaryColor;
    protected $primaryHighlight;
    protected $secondaryColor;
    protected $secondaryHighlight;

    /**
     * AbstractGenerator constructor.
     *
     * @param string $seed
     */
    public function __construct(string $seed)
    {
        // convert hash seed into an array of 16 hex numbers for easy manipulation
        $this->seed = $seed;

        // create base svg to draw on
        $this->svg = new \SimpleXMLElement(file_get_contents(__DIR__.'/../../assets/base.svg'));

        $this->calculateColors();
    }

    abstract public function generate(): string;

    private function calculateColors()
    {
        // calculate primary color from 6 first chars
        $this->primaryColor = [
            hexdec(substr($this->seed, 0, 2)),
            hexdec(substr($this->seed, 2, 2)),
            hexdec(substr($this->seed, 4, 2)),
        ];

        // calculate brightness to know which color to use for highlight
        // (R*299 + G*587 + B*114) / 1000 (function comes from https://www.w3.org/TR/AERT/#color-contrast)
        $primaryBrightness = ($this->primaryColor[0]*299 + $this->primaryColor[1]*587 + $this->primaryColor[2]*114) / 1000;
        if ($primaryBrightness > 122.5) {
            $this->primaryHighlight = [0, 0, 0];
        } else {
            $this->primaryHighlight = [255, 255, 255];
        }

        // calculate secondary color from 6 next chars
        $this->secondaryColor = [
            hexdec(substr($this->seed, 6, 2)),
            hexdec(substr($this->seed, 8, 2)),
            hexdec(substr($this->seed, 10, 2)),
        ];
        $secondaryBrightness = ($this->secondaryColor[0]*299 + $this->secondaryColor[1]*587 + $this->secondaryColor[2]*114) / 1000;
        if ($secondaryBrightness > 122.5) {
            $this->secondaryHighlight = [0, 0, 0];
        } else {
            $this->secondaryHighlight = [255, 255, 255];
        }
    }
}
