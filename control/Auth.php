<?php


class Auth
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // ログイン処理
    public function login(string $mail, string $password): void
    {
        $sql = "SELECT password FROM users WHERE mail = :mail";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':mail', $mail);
        $statement->execute();
        $user = $statement->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $mail;
                header('Location: ../list.php');
            } else {
                array_push($_SESSION['errors'], 'メールアドレスまたはパスワードが違います。');
            }
        }
    }

    // ログアウト処理
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        header('Location: ../login/index.php');
        exit;
    }

    // ログインしているかのチェック
    public static function isLogin(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: logout/index.php');
            exit;
        }
    }
}
