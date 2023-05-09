<?php 

session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/funcs.php';

if (isset($_POST['register'])) {
    registration();
    header("Location: identify.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>firstProject</title>
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
        
            <div class="starting">
                <div class="enter">
                    <ul>
                        <li class="ent"><a href="" class="btn btn-big openmodal">Вход</a></li>
                        <li class="reg"><a href="" class="btn btn-big openmodall">Регистрация</a></li>
                    </ul>
                </div>
            </div>

                <div class="modal">
                    <div class="login" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-header">
                                <h2>Войдите в свой аккаунт</h2>
                                <a href="" class="btn-close closemodal" aria-hidden="true">&times;</a>
                            </div>

                                <form action="index.php" method="post">
                                    <div class="modal-body">
                                        <input type="text" name="user" placeholder="Имя пользователя" size="20" /><br>
                                        <input type="text" name="pass" placeholder="Пароль" size="20" />
                                    </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="auth" class="goin">Авторизоваться </button>
                                        </div>
                                </form>
                                
                        </div>
                    </div>
                </div>

                <div class="modall">
                    <div class="login" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-header">
                                <h2>Окно регистрации</h2>
                                <a href="" class="btn-close closemodall" aria-hidden="true">&times;</a>
                            </div>

                                <form action="identify.php" method="post">
                                    <div class="modal-body">
                                        <input type="text" name="login" placeholder="Имя пользователя" size="20" /><br>
                                        <input type="password" name="pass" placeholder="Пароль" size="20" />
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="register" class="goin">Регистрация</button>
                                    </div>
                                </form>
                                
                        </div>
                    </div>
                </div>
                

            
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script  src="/js/jQuery.js"></script>
    </body>
</html>