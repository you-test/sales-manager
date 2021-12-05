<?php

class Auth
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // ログイン処理
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mail = $_POST['mail'];
            $password = $_POST['password'];

            $sql = "SELECT password FROM users WHERE mail = :mail";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':mail', $mail);
            $statement->execute();
            $user = $statement->fetch();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    header('Location: ../list.php');
                }
            } else {
                exit;
            }
        }
    }
}
