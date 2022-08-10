<?php

class Db
{
    protected PDO $pdo;

    public function __construct()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $this->pdo = new PDO("mysql:host=localhost;dbname=TestTask;charset=utf8", "nyzhnui", "qwerty", $options);
    }

    public function getInstance(): object
    {
        if (empty($this->instance)) {
            $this->instance = new self();
        }
        return $this->instance;
    }

    public function get(string $request): bool|array
    {
        $prepare = $this->pdo->prepare($request);

        try {
            if ($prepare->execute()) {
                return $prepare->fetchAll();
            }
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    public function send(string $request): bool
    {
        $prepare = $this->pdo->prepare($request);
        $prepare->execute();
        $updateRows = $prepare->rowCount();

        try {
            if ($updateRows >= 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
           var_dump($e->getMessage());
        }
    }
}