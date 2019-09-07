<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>

        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    </head>
    <body>

        <header>
            <h1>YEEEEEEEEEEEEEEEEET</h1>
        </header>

        <?php
            if (isset($_GET['login_failed']) && $_GET['login_failed'] == 1) {
                echo '<h2 class="warning">Password or username was invalid.</h2>';
            }
        ?>

        <main>
            <?php include("login_form.php") ?>
            <button onClick="window.location.href='create_user_page.php'">Create Account</button>
        </main>

    </body>
</html>