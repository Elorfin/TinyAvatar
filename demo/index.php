<?php
    require_once 'autoload.php';
    use Elorfin\TinyAvatar\TinyAvatar;

    $testSuite = [
        'penin.axel@gmail.com',
        'elorfin_mein@hotmail.com',
        'axel.penin@claroline.com',
        'penin.axel@orange.fr',
        'james.kirk@enterprise.com',
        'test@email.com',
        'test1@email.com',
        'test2@email.com',
        'test3@email.com',
        'test4@email.com',
        'test5@email.com',
        'test6@email.com',
        'test7@email.com',
        'test8@email.com',
        'test9@email.com',
        'test10@email.com',
        'test11@email.com',
        'test12@email.com',
        'test13@email.com',
        'test14@email.com',
        'test15@email.com',
        'test16@email.com',
        'test17@email.com',
        'test18@email.com',
        'test19@email.com',
        'test20@email.com',
        'test21@email.com',
        'test22@email.com',
        'test23@email.com',
        'test24@email.com',
        'test25@email.com',
        'test26@email.com',
        'test27@email.com',
        'test28@email.com',
        'claroline@connect.com',
        'glouglou@gmail.com',
        'john.doe@yahoo.fr',
        'john.smith@hormail.fr',
        'jane.doe@orange.fr',
        'jane.watts@gmail.fr',
        'paulineballot@yahoo.fr',
        'contact@claroline.com',
        'support@claroline.com',
        'claroline@connect.fr',
        'another@test.fr',
        'TinyAvatar',
        'Elorfin',
        'Corum',
        'Claroline Connect'
    ];

    function render($variant, $testCase, $className = "") {
        $avatar = TinyAvatar::generate($variant, $testCase);

        echo "<div class=\"avatar {$className} avatar-sm\">{$avatar}</div>";

        /*echo "
            <div class=\"avatar-preview\">
                <div class=\"avatar {$className} avatar-lg\">{$avatar}</div>

                <div class=\"avatar {$className} avatar-sm\">{$avatar}</div>

                <div class=\"avatar {$className} avatar-xs\">{$avatar}</div>
            </div>
        ";*/
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
