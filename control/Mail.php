<?php

class Mail
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // メールアドレスの新規登録
    public function createMail(): void
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
    public function getMails(): array
    {
        $statement = $this->pdo->query("SELECT id, mail FROM sendreport_adress");
        $statement->execute();
        $mails = $statement->fetchAll();

        return $mails;
    }

    // メールアドレスリストの登録
    public function registerMails(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['mail']) {
            $mails = $_POST['mail'];
            $ids = $_POST['id'];
            $mailLists = [];
            foreach ($mails as $key => $mail) {
                $mailLists[] = [$mail, (int) $ids[$key]];
            }
            print_r($mailLists);

            foreach ($mailLists as $mailList) {
                $statement = $this->pdo->prepare("UPDATE sendreport_adress SET mail = :mail WHERE id = :id");
                $statement->bindValue(':mail', $mailList[0]);
                $statement->bindValue(':id', $mailList[1]);
                $statement->execute();
            }
        }
    }

    // メールアドレスの削除
    public function deleteMail(): void
    {
        $id = $_POST['id'];
        $statement = $this->pdo->query("DELETE FROM sendreport_adress WHERE id = $id");
        $statement->execute();

        header('Location: mail.php');
    }
}
