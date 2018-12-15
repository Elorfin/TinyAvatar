<?php

namespace Elorfin\TinyAvatar;

use Elorfin\TinyAvatar\Generator\AbstractGenerator;

class TinyAvatar
{
    /**
     * Generate a TinyAvatar for `input` string.
     *
     * @param string $type  - the type of avatar to draw. Must be one of : 'bot', 'invader', 'monster'.
     * @param string $input - the string to use as generation seed. Should be unique to ensure uniqueness of avatars.
     *
     * @return mixed
     */
    static public function generate(string $type, string $input)
    {
        $availableGenerators = array_keys(static::getGenerators());
        if (!in_array($type, $availableGenerators)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid parameter `type` provided. Expected one of : %s.', implode(', ', $availableGenerators))
            );
        }

        if (empty($input)) {
            throw new \InvalidArgumentException('Cannot generate TinyAvatar for empty strings.');
        }

        // get the correct generator class
        $generatorClass = static::getGenerator($type);
        /** @var AbstractGenerator $generator */
        $generator = new $generatorClass;

        // generate hash seed from the input string
        $seed = md5($input);

        return $generator->generate($seed);
    }

    /**
     * Gets the list of implemented avatar generation strategy.
     *
     * @return array
     */
    static public function getGenerators(): array
    {
        return [
            'bot'     => 'Elorfin\TinyAvatar\Generator\BotGenerator',
            'invader' => 'Elorfin\TinyAvatar\Generator\InvaderGenerator',
            'monster' => 'Elorfin\TinyAvatar\Generator\MonsterGenerator',
        ];
    }

    static public function getGenerator($type): string
    {
        return static::getGenerators()[$type];
    }
}
