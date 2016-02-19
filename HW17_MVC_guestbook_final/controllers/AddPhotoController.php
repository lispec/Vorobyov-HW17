<?php

class AddPhotoController extends BaseController {
    public function execute($arguments = []) {

        if(UserSession::getInstance()->isGuest) {
            Router::redirect('/');
        }

        if(isset($_FILES['photo'])) {
            $uri = Picture::uploadFile($_FILES['photo']['tmp_name'], $_FILES['photo']['name'], UserSession::getInstance()->username);
            $db = new FileDB();
            $db->addPhoto(UserSession::getInstance()->username, $uri, $_POST['description']);
            Router::redirect('/user/' . UserSession::getInstance()->username);
        }

        require_once 'views/parts/header.php';

        require_once 'views/addPhoto.php';

        require_once 'views/parts/footer.php';


        return true;
    }
}