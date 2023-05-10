<?php 

function registration(): bool
{
    global $pdo;

    $login = !empty($_POST['login']) ? trim($_POST['login']) : '';
    $pass = !empty($_POST['pass']) ? trim($_POST['pass']) : '';

    if (empty($login) || empty($pass)) {
        $_SESSION['errors'] = 'Заполните оба поля';
        return false;
    }

    $res = $pdo->prepare("SELECT COUNT(*) FROM users WHERE login = ?");
    $res->execute([$login]);
    if ($res->fetchColumn()) {
        $_SESSION['errors'] = 'Имя занято';
        return false;
    }

    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $res = $pdo->prepare("INSERT INTO users (login, pass) VALUES (?,?)");
    if ($res->execute([$login, $pass])) {
        $_SESSION['success'] = 'Успешная регистрация';
        return true;
    } else {
        $_SESSION['errors'] = 'Ошибка регистрации';
        return false;
    }
}

function login(): bool 
{
    global $pdo;

    $login = !empty($_POST['login']) ? trim($_POST['login']) : '';
    $pass = !empty($_POST['pass']) ? trim($_POST['pass']) : '';

    if (empty($login) || empty($pass)) {
        $_SESSION['errors'] = 'Оба поля оязательны';
        return false;
    }

    $res = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $res ->execute([$login]);
    if (!$user = $res->fetch()) {
        $_SESSION['errors'] = 'Не верный логин или пароль';
        return false;
    }

    if (!password_verify($pass, $user['pass'])) {
        $_SESSION['errors'] = 'Не верный логин или пароль';
        return false;
    } else {
        $_SESSION['success'] = '';
        $_SESSION['user']['name'] = $user['login'];
        $_SESSION['user']['id'] = $user['id'];
        return true;
    }
}

function saveMessage(): bool
{
    global $pdo;
    $message = !empty($_POST['message']) ? trim($_POST['message']) : '';
    
    if (!isset($_SESSION['user']['name'])) {
        $_SESSION['errors'] = 'Войдите';
        return false;
    }
    
    if (empty($message)) {
        $_SESSION['errors'] = 'Введите сообщение';
        return false;
    }

    $res = $pdo->prepare("INSERT INTO messages (name, messages) VALUES (?,?)");
    if ($res->execute([$_SESSION['user']['name'], $message],)) {
        $_SESSION['success'] = '';
        return true;
    } else {
        $_SESSION['errors'] = 'Ошибка';
        return false;
    }
}

function getMessages(): array
{
    global $pdo;
    $res = $pdo->query("SELECT * FROM messages");
    return $res->fetchAll();
}
