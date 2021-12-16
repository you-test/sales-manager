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
        require_once '../common/Validation.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $_SESSION['errors'] = [];

            // 空入力チェック
            Validation::emptyCheck($_SESSION['errors'], $mail, 'メールアドレスを入力してください。');
            Validation::emptyCheck($_SESSION['errors'], $password, 'パスワードを入力してください。');

            // 文字数チェック
            Validation::maxCheck($_SESSION['errors'], $mail, 'メールアドレスは255文字以内で入力してください。', 255);
            Validation::minCheck($_SESSION['errors'], $password, 'パスワードは8文字以上で入力してください。', 8);
            Validation::maxCheck($_SESSION['errors'], $password, 'パスワードは255文字以内で入力してください。', 255);

            if (!$_SESSION['errors']) {
                // メールアドレスチェック
                Validation::mailCheck($_SESSION['errors'], $mail, '正しいメールアドレスを入力してください。');

                // パスワードの半角英数字チェック
                Validation::halfAlphanumericalCheck($_SESSION['errors'], $password, 'パスワードは半角英数字で入力してください。');
            }

            if ($_SESSION['errors']) {
                header('Location: index.php');
            }

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

    // ログアウト処理

    // ログインしているかのチェック
}
