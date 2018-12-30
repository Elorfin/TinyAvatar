<?php

namespace Elorfin\TinyAvatar\Generator;

class BotGenerator extends AbstractGenerator
{
    protected function getAssetPath(): string
    {
        return __DIR__.'/../../assets/bot';
    }

    public function generate(): string
    {
        return 'bot';
    }
}
