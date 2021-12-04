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

    // 編集画面に最初に入れておく値の取得
    public function getUpdateUserData($id) {
        $sql = "SELECT * FROM users WHERE id = $id";
        $statement = $this->pdo->query($sql);
        $statement->execute();
        $userdata = $statement->fetch();

        return $userdata;
    }

    // ユーザーデータのアップデート
    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['id'];
            $name = $_POST['name'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET name = :name, mail = :mail, password = :hash WHERE id = :id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':mail', $mail);
            $statement->bindValue(':hash', $hash);
            $statement->bindValue(':id', $id);
            $result = $statement->execute();

            if ($result) {
                $session['id'] = '';
                header('Location: index.php');
            }
        }
    }
}
