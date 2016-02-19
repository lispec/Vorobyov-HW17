<?php

class IndexController extends BaseController {
    public function execute($arguments = []) {

        if (!UserSession::getInstance()->isGuest) {
            Router::redirect('/user/' . UserSession::getInstance()->username);
        }

        if (
            isset($_POST['username']) &&
            isset($_POST['password']) &&
            !empty($_POST['username']) &&
            !empty($_POST['password'])
        ) {
            $fdb = new FileDB(__DIR__ . '/../db');
            if ($fdb->findUser($_POST['username'], $_POST['password'])) {
                UserSession::getInstance()->login($_POST['username']);
                Router::redirect('/user/' . UserSession::getInstance()->username);
            } else {
                $error = "Failed: Login and password not valid.";
            }
        } else if(
            isset($_POST['username']) &&
            isset($_POST['password'])
        ) {
            $error = "Failed: All fields are required.";
        }

        require_once 'views/parts/header.php';

        require_once 'views/main.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}