<?php

class ZipController extends BaseController {
    public function execute($arguments = []) {

        $zip = new ZipArchive();
        $zip->open('zip/' . UserSession::getInstance()->username . '.zip', ZipArchive::CREATE);
        $f = new FileDB();
        $photos = $f->getPhotos(UserSession::getInstance()->username, 1, 500);

        foreach($photos as $photo) {
            $photoUri = $photo['photoURI'];
            $path = 'pictures/' . UserSession::getInstance()->username . '/' . $photoUri;
            $zip->addFile($path, $photoUri);
        }

        $zip->close();

        Router::redirect('/zip/' . UserSession::getInstance()->username . '.zip');

        return true;
    }
}