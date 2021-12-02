<?php

class Users
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // ユーザーデータの取得
    public function getUsersData()
    {
        $sql = "SELECT id, name, mail FROM users";
        $statement = $this->pdo->query($sql);
        $statement->execute();
        $usersdata = $statement->fetchAll();

        return $usersdata;
    }

    // ユーザー登録処理
    public function userRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, mail, password) VALUES (:name, :mail, :hash)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':mail', $mail);
            $statement->bindValue(':hash', $hash);
            $result = $statement->execute();

            if ($result) {
                header('Location: index.php');
            }
        }
    }
}
