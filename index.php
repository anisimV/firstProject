<?php 

session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/funcs.php';

if (isset($_GET['do']) && $_GET['do'] == 'exit') {
    if (!empty($_SESSION['user']['name'])) {
        unset($_SESSION['user']);
    }
    header("Location: identify.php");
    die;
}

if (isset($_POST['add'])) {
    saveMessage();
    header("Location: index.php");
    die;
}

$messages = getMessages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <div class="container">

            <div class="aut">
                <div class="col">
                    <?php if (!empty($_SESSION['errors'])): ?>
                        <div class="errors">
                            <?php
                                echo $_SESSION['errors'];
                                unset($_SESSION['errors']);
                            ?>
                        </div>

                    <?php endif; ?>
                    
                    <?php if (!empty($_SESSION['success'])): ?>
                        <div class="success">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="greeting">
                    <?php if (!empty($_SESSION['user']['name'])): ?>
                    <p>Добро пожаловать, <?= htmlspecialchars($_SESSION['user']['name']) ?>! <a href="?do=exit">Выйти</a></p>
                </div>
            </div>
        
            <div>
                <form action="index.php" method="post" class="">
                    <div class="">
                        <div class="">
                            <textarea class="" name="message" placeholder="Введите текст"
                            id="floatingTextarea" style="height: 100px;"></textarea>
                        </div>
                    </div>

                    <div class="">
                        <button type="submit" name="add" class="">Отправить</button>
                    </div>
                </form>

    <?php if (!empty($messages)): ?>
        
                <div class="row">
                    <div class="">
                        <hr>
                        <?php foreach ($messages as $message): ?>
                        <div class="">
                            <div class="">
                                <h5 class="">Автор: <?= htmlspecialchars($message['name'])?></h5>
                                <p class=""><?= htmlspecialchars($message['messages'])?></p>
                                <p>Дата: <?= $message['created_at'] ?></p>
                                <hr size=3px width=500px align="left" color="red">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                        <?php endif; ?>
                <?php else: ?>
                    <a href="/identify.php">Авторизируйтесь</a>
                <?php endif; ?>
            </div>
        </div>

    </body>
</html>
