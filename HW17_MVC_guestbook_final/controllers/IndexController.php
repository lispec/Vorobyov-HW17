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


        echo $this->render('main.twig', [
            'error' => isset($error) ? $error : false,
            'title' => 'Main Page',
            'heading' => 'Hello PHP!!!'
        ]);

        return true;
    }
}