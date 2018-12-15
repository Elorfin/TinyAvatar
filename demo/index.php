<?php
    require_once 'autoload.php';
    use Elorfin\TinyAvatar\TinyAvatar;

    $testSuite = [
        'penin.axel@gmail.com',
        'elorfin_mein@hotmail.com',
        'test@email.com',
        'test2@email.com',
        'test1@email.com',
        'claroline@connect.com',
        'glouglou@gmail.com',
        'john.doe@yahoo.fr',
        'john.smith@hormail.fr',
        'jane.doe@orange.fr',
    ];

    function render($variant, $testCase, $className = "") {
        $avatar = TinyAvatar::generate($variant, $testCase);

        echo "
            <div class=\"avatar-preview\">
                <div class=\"avatar {$className} avatar-lg\">{$avatar}</div>

                <div class=\"avatar {$className} avatar-sm\">{$avatar}</div>

                <div class=\"avatar {$className} avatar-xs\">{$avatar}</div>
            </div>
        ";
    }
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />

        <title>TinyAvatar</title>
        <meta name="description" content="" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
        <link rel="stylesheet" href="./styles.css" />
    </head>

    <body class="container">
        <h1>TinyAvatar</h1>

        <section>
            <h2>Monsters</h2>

            <?php
                foreach ($testSuite as $testCase) {
                    //render('monster', $testCase);
                    render('monster', $testCase, 'avatar-round');
                }
            ?>
        </section>

        <section>
            <h2>Bots</h2>
        </section>

        <section>
            <h2>Invaders</h2>

            <?php
                foreach ($testSuite as $testCase) {
                    //render('monster', $testCase);
                    render('invader', $testCase, 'avatar-round');
                }
            ?>
        </section>
    </body>
</html>
