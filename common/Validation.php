<?php

class Validation
{
    // 空文字チェック
    public static function emptyCheck(&$errors, $checkValue, $message)
    {
        if (empty(trim($checkValue))) {
            $errors[] = $message;
        }
    }

    // 最小文字数チェック
    public static function minCheck(&$errors, $checkValue, $message, $minStr)
    {
        if (mb_strlen($checkValue) < $minStr) {
            $errors[] = $message;
        }
    }

    // 最大文字数チェック
    public static function maxCheck(&$errors, $checkValue, $message, $maxStr)
    {
        if (mb_strlen($checkValue) > $maxStr) {
            $errors[] = $message;
        }
    }

    // メールアドレスチェック
    public static function mailCheck(&$errors, $checkValue, $message)
    {
        if (filter_var($checkValue, FILTER_VALIDATE_EMAIL)) {
            $errors[] = $message;
        }
    }

    // 半角英数字チェック
    public static function halfAlphanumericalCheck(&$errors, $checkValue, $message) {
        if (preg_match("/^[a-zA-Z0-9]+$/", $checkValue)) {
            $errors[] = $message;
        }
    }

    // アドレス重複チェック
    public static function duplicateMailCheck(&$errors, $checkValue, $message, $pdo) {
        $sql = "SELECT id FROM users WHERE mail = :mail";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':mail', $checkValue);
        $statement->execute();
        $result = $statement->fetch();

        if ($result) {
            $errors[] = $message;
        }
    }
}
