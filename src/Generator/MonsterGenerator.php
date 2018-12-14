<?php

namespace Elorfin\TinyAvatar\Generator;

class MonsterGenerator extends AbstractGenerator
{
    static public function generate(string $seed)
    {
        // | 1f 38 70 | be | 27 | 4f | 6c | 49 | b3 e3 1a 0c 67 28 95 7f
        // | color | head | mouth | eyes | hasHands | hands |

        //$svgTemplate = new \SimpleXMLElement($this->webDir.'/'.$this->templatePath);

        // calculate primary color from 6 first chars
        $primaryColor = substr($seed, 0, 6);

        // generate a complementary color for secondary
        //$secondaryColor = shuffle();
    }

    private function drawHead()
    {

    }

    private function drawBody()
    {

    }

    static private function drawEyes()
    {

    }
}
