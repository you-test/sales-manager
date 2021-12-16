<?php

class Validation
{
    // 空文字チェック
    public static function emptyCheck(array &$errors, string $checkValue, string $message): void
    {
        if (empty(trim($checkValue))) {
            array_push($errors, $message);
        }
    }

    // 最小文字数チェック
    public static function minCheck(array &$errors, string $checkValue, string $message, int $minStr): void
    {
        if (mb_strlen($checkValue) < $minStr) {
            array_push($errors, $message);
        }
    }

    // 最大文字数チェック
    public static function maxCheck(array &$errors, string $checkValue, string $message, int $maxStr): void
    {
        if (mb_strlen($checkValue) > $maxStr) {
            array_push($errors, $message);
        }
    }

    // メールアドレスチェック
    public static function mailCheck(array &$errors, string $checkValue, string $message): void
    {
        if (filter_var($checkValue, FILTER_VALIDATE_EMAIL) == false) {
            array_push($errors, $message);
        }
    }

    // 半角英数字チェック
    public static function halfAlphanumericalCheck(array &$errors, string $checkValue, string $message): void
    {
        if (preg_match("/^[a-zA-Z0-9]+$/", $checkValue) == false) {
            array_push($errors, $message);
        }
    }

    // アドレス重複チェック
    public static function duplicateMailCheck(array &$errors, string $checkValue, string $message, object $pdo): void
    {
        $sql = "SELECT id FROM users WHERE mail = :mail";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':mail', $checkValue);
        $statement->execute();
        $result = $statement->fetch();

        if ($result) {
            array_push($errors, $message);
        }
    }
}
