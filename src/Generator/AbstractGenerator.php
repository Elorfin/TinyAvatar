<?php

namespace Elorfin\TinyAvatar\Generator;

abstract class AbstractGenerator
{
    abstract public function generate(string $seed): string;
}
