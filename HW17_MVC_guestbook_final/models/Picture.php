<?php

class Picture {
    public static function formatDate($dateStr) {
        $date = new DateTime($dateStr);
        $date->add(new DateInterval("PT2H"));
        return $date->format('d.m.Y H:i');

        //d.m.Y H:i:s
        //Y-m-d H:i:s
    }

    public static function uploadFile($tmpPath, $fileName, $username) {
        $pictureDir = __DIR__ . '/../pictures';
        $usernameDir = $pictureDir . '/' . $username;

        if(!file_exists($usernameDir)) {
            mkdir($usernameDir);
        }

        $pahInfo = pathinfo($fileName);
        $ext = isset($pahInfo['extension']) ? $pahInfo['extension'] : 'jpg';
        $time = time();
        $fileName = $time . '.' . $ext;
        $imageNewPath = $usernameDir . '/' . $fileName;
        move_uploaded_file($tmpPath, $imageNewPath);

        return $fileName;
    }
}