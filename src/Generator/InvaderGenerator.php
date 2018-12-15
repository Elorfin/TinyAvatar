<?php

namespace Elorfin\TinyAvatar\Generator;

class InvaderGenerator extends AbstractGenerator
{
    private $pixels = 5;

    public function generate(string $seed): string
    {
        $padding = 140;
        $pixelSize = (800 - 2*$padding) / $this->pixels;
        // Get color from first 6 characters
        $color = substr($seed, 0, 6);
        // Create an array to store our boolean "pixel" values
        $pixels = [];

        // Make it a 5x5 multidimensional array
        for ($i = 0; $i < $this->pixels; $i++) {
            for ($j = 0; $j < $this->pixels; $j++) {
                $pixels[$i][$j] = hexdec(substr($seed, ($i * $this->pixels) + $j + $this->pixels + 1, 1))%2 === 0;
            }
        }

        $svgImage = new \SimpleXMLElement(file_get_contents(__DIR__.'/../../assets/base.svg'));

        // Color the pixels
        for ($k = 0; $k < count($pixels); $k++) {
            for ($l = 0; $l < count($pixels[$k]); $l++) {
                // If the value in the $pixels array is true, make the pixel color the primary color
                if ($pixels[$k][$l]) {
                    $pixel = $svgImage->addChild('rect');

                    $pixel->addAttribute('x', $padding + $k * $pixelSize);
                    $pixel->addAttribute('y', $padding + $l * $pixelSize);
                    $pixel->addAttribute('width', $pixelSize);
                    $pixel->addAttribute('height', $pixelSize);
                    $pixel->addAttribute('fill', "#{$color}");
                }
            }
        }

        return $svgImage->asXML();
    }
}
