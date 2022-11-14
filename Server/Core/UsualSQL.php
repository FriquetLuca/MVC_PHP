<?php

namespace App\Core;
use PDO;
use App\Core\Query;

class UsualSQL extends Query {
    public function createDB($dbName) {
        $req = $this->db->prepare("CREATE DATABASE IF NOT EXISTS ?");
        $req->execute([ $dbName ]);
        $req->close();
        return new Query($dbName);
    }
    public function dbExist($dbName) {
        $install = false;
        $req = $this->db->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?");
        $dbcount = $req->execute([ $dbName ]);
        if($dbcount->rowCount() != 0)
        {
            $install = true;
        }
        $req->close();
        $dbcount->close();
        return $install;
    }
}