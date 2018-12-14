<?php

namespace Elorfin\TinyAvatar;

class TinyAvatar
{
    /**
     * Create a TinyAvatar for `input` string.
     *
     * @param string $type  - the type of avatar to draw. Must be one of : 'bot', 'invader', 'monster'.
     * @param string $input - the string to use as generation seed. Should be unique to ensure uniqueness of avatars.
     *
     * @return mixed
     */
    static public function draw(string $type, string $input)
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

        // Generates hash seed from the input string
        $seed = md5($input);

        $drawing = call_user_func([static::getGenerator($type), 'generate'], $seed);

        return $drawing;
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
