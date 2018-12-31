---
layout: documentation
title: Usage
---

# Usage

The library only exposes one singleton class `TinyAvatar`.

## Include TinyAvatar

If you have an autoloader:

```php
use Elorfin\TinyAvatar\TinyAvatar;
```

Otherwise, in old school PHP (yes, do not have an autoloader in 2019 is old school):

```php
require_once 'path/to/tiny-avatar/src/TinyAvatar.php';
```

## Generate an avatar

```php
TinyAvatar::generate('bot', 'test@email.com');
TinyAvatar::generate('invader', 'test@email.com');
TinyAvatar::generate('monster', 'test@email.com');
```
