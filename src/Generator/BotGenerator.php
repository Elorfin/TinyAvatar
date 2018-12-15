<?php

namespace Elorfin\TinyAvatar\Generator;

class BotGenerator extends AbstractGenerator
{
    protected function getAssetPath(): string
    {
        return 'bot';
    }

    public function generate(string $seed): string
    {
        return 'bot';
    }
}
