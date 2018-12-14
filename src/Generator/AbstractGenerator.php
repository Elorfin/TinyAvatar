<?php

namespace Elorfin\TinyAvatar\Generator;

abstract class AbstractGenerator
{
    abstract static public function generate(string $seed): string;
}
