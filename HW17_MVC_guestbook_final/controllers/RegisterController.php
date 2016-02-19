<?php

class RegisterController extends BaseController {
    public function execute($arguments = []) {

        if (
            isset($_POST['username']) &&
            isset($_POST['password']) &&
            isset($_POST['password-confirm']) &&
            !empty($_POST['username']) &&
            !empty($_POST['password'])

        ) {
            if ($_POST['password'] == $_POST['password-confirm']) {
                $fdb = new FileDB(__DIR__ . '/../db');
                if (!$fdb->findUsername($_POST['username'])) {
                    $fdb->addUser($_POST['username'], $_POST['password']);
                    UserSession::getInstance()->login($_POST['username']);
                    Router::redirect('/');
                } else {
                    $error = "Failed: User already exists.";
                }
            } else {
                $error = "Failed: Password does not match.";
            }
        } else if(
            isset($_POST['username']) &&
            isset($_POST['password']) &&
            isset($_POST['password-confirm'])
        ) {
            $error = "Failed: All fields is required.";
        }

        require_once 'views/parts/header.php';

        require_once 'views/register.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}