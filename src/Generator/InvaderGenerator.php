<?php

namespace Elorfin\TinyAvatar\Generator;

class InvaderGenerator extends AbstractGenerator
{
    /**
     * Generates identicon for input string.
     *
     * @param string      $seed
     */
    static public function generate(string $seed)
    {
        // Get color from first 6 characters
        $color = substr($seed, 0, 6);
        // Create an array to store our boolean "pixel" values
        $pixels = [];

        // Make it a 5x5 multidimensional array
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $pixels[$i][$j] = hexdec(substr($seed, ($i * 5) + $j + 6, 1))%2 === 0;
            }
        }

        // Create image
        $image = imagecreatetruecolor(400, 400);
        // Allocate the primary color. The hex code we assigned earlier needs to be decoded to RGB
        $color = imagecolorallocate($image, hexdec(substr($color,0,2)), hexdec(substr($color,2,2)), hexdec(substr($color,4,2)));
        // And a background color
        $bg = imagecolorallocate($image, 238, 238, 238);

        // Color the pixels
        for ($k = 0; $k < count($pixels); $k++) {
            for ($l = 0; $l < count($pixels[$k]); $l++) {
                // Default pixel color is the background color
                $pixelColor = $bg;

                // If the value in the $pixels array is true, make the pixel color the primary color
                if ($pixels[$k][$l]) {
                    $pixelColor = $color;
                }

                // Color the pixel. In a 400x400px image with a 5x5 grid of "pixels", each "pixel" is 80x80px
                imagefilledrectangle($image, $k * 80, $l * 80, ($k + 1) * 80, ($l + 1) * 80, $pixelColor);
            }
        }

        return $image;

        // Output the image
        //header('Content-type: image/png');
        //imagepng($image, $outputPath);
    }
}
