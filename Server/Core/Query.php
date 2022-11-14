<?php

namespace App\Core;
use PDO;
use Dotenv\Dotenv;

class Query {
    private $db;
    public function __construct($dbName) {
        try
        {
            $dotenv = Dotenv::createImmutable(__ROOT__);
            $dotenv->safeLoad();
            $host = $_ENV['HOST'];
            // On se connecte à MySQL
            $this->db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $_ENV['USERNAME'], $_ENV['PASSWORD']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
    /**
     * Select every value from a query.
    */
    public function fetchAll($query, $exec = null) {
        $req = $this->db->prepare($query);
        $req->execute($exec);
        $res = $req->fetchAll();
        $req = null;
        return $res;
    }
    /**
     * Select a specific value from a query.
    */
    public function fetchAssoc($query, $exec = null) {
        $req = $this->db->prepare($query);
        $req->execute($exec);
        $res = $req->fetch(PDO::FETCH_ASSOC);
        $req = null;
        return $res;
    }
    /**
     * Select a specific column from a query.
    */
    public function fetchColumn($query, $exec = null) {
        $req = $this->db->prepare($query);
        $req->execute($exec);
        $res = $req->fetchColumn();
        $req = null;
        return $res;
    }
    /**
     * Execute a query. (Ex: delete, trigger, update, ...).
     */
    public function execute($query, $exec = null) {
        $req = $this->db->prepare($query);
        $req->execute($exec) or die(print_r($this->db->errorInfo()));
        $req = null;
    }
    /**
     * Prepare the db with your $query, the $exec should be a function to handle what you're gonna do with the request variable.
     */
    public function prepare($query, $exec) {
        $req = $this->db->prepare($query);
        $exec($req);
        $req = null;
    }
    /**
     * Kill the PDO connection.
     */
    public function kill() {
        $this->db = null;
    }
}