<?php

namespace App\Db;

use PDO;
use PDOException;

class Db extends PDO
{
    // Instance unique de la classe (singleton)
    private static $instance;

    // Informations de connexion
    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    private const DB_NAME = 'demo_poo';

    private function __construct()
    {
        //DSN de connexion
        $_dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST;

        // On appelle le constructeur de la classe PDO (grâce à l'extends)
        // (ce qui remplace le « $db= new PDO($_dsn, "root", "") »)
        // + On lève une exception si il y a un problème
        try {
            parent::__construct($_dsn, self::DB_USER, self::DB_PASS);

            // Permet de faire toutes les transitions sur de l' UTF8
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            // Permet d'avoir un tableau associatif lorsque l'on fait un FETCH ou un FETCH ALL ('nom de colonne' => 'valeur')
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // (definit le mode de transfert d'erreur) Déclenche une exception lors d'erreur
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}