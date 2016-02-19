<?php

class LogoutController extends BaseController {
    public function execute($arguments = []) {
        if(!UserSession::getInstance()->isGuest) {
            UserSession::getInstance()->logout();
        }

        Router::redirect('/');
    }
}