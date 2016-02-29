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

        echo $this->render('register.twig', [
            'error' => isset($error) ? $error : false,
            'username' => isset($_POST['username']) ? $_POST['username'] : '',
            'title' => 'Register'
        ]);

        return true;
    }
}