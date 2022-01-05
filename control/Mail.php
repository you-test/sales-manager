<?php

class Mail
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // メールアドレスの新規登録
    public function createMail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_mail'])) {
            $mail = $_POST['new_mail'];

            $statement = $this->pdo->prepare("INSERT INTO sendreport_adress (mail) VALUES (:mail)");
            $statement->bindValue(':mail', $mail);
            $statement->execute();

            header('Location: mail.php');
        }
    }

    // 登録済みメールアドレスの取得
    public function getMails()
    {
        $statement = $this->pdo->query("SELECT id, mail FROM sendreport_adress");
        $statement->execute();
        $mails = $statement->fetchAll();

        return $mails;
    }

    // メールアドレスリストの登録
    public function registerMails()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['mail']) {
            $mails = $_POST['mail'];

            $statement = $this->pdo->prepare("UPDATE sendreport_adress SET");
        }
    }
}
