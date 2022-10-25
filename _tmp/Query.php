<?php

namespace App\Core;
use PDO;

class Query {
    protected $db;
    public function __construct($dbName = "", $host = "localhost", $user = 'root', $pswd = '') {
        $pdoInstruct = "mysql:host=$host;dbname=$dbName;charset=utf8";
        if(!isset($dbName) || (isset($dbName) && $dbName == "")) {
            $pdoInstruct = "mysql:host=$host;charset=utf8";
        }
        $this->db = new PDO($pdoInstruct, $user, $pswd);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * Select every value from a query.
    */
    public function fetchAll($query, $exec = null) {
        $req = $this->db->prepare($query);
        $req->execute($exec);
        $res = $req->fetchAll();
        $req->close();
        return $res;
    }
    /**
     * Select a specific value from a query.
    */
    public function fetchAssoc($query, $exec = null) {
        $req = $this->db->prepare($query);
        $req->execute($exec);
        $res = $req->fetch(PDO::FETCH_ASSOC);
        $req->close();
        return $res;
    }
    /**
     * Select a specific column from a query.
    */
    public function fetchColumn($query, $exec = null) {
        $req = $this->db->prepare($query);
        $req->execute($exec);
        $res = $req->fetchColumn();
        $req->close();
        return $res;
    }
    /**
     * Execute a query. (Ex: delete, trigger, update, ...).
     */
    public function execute($query, $exec = null) {
        $req = $this->db->prepare($query);
        $req->execute($exec) or die(print_r($this->db->errorInfo()));
        $req->close();
    }
    /**
     * Prepare the db with your $query, the $exec should be a function to handle what you're gonna do with the request variable.
     */
    public function prepare($query, $exec) {
        $req = $this->db->prepare($query);
        $exec($req);
        $req->close();
    }
    public function transaction($allTransactions) {
        try {
            $this->db->beginTransaction();
            foreach($allTransactions as $query => $exec) {
                $this->db->execute($query, $exec);
            }
            $this->db->commit();
        } catch(PDOException $e) {
            $this->db->rollback();
            return [ 'valid' => false, 'error' => $e->getMessage() ];
        }
        return [ 'valid' => true ];
    }
    /**
     * Kill the PDO connection.
     */
    public function kill() {
        $this->db->close();
    }
}