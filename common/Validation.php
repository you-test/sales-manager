<?php

class Validation
{
    // 空文字チェック
    public static function emptyCheck(&$errors, $checkValue, $message)
    {
        if (empty(trim($checkValue))) {
            array_push($errors, $message);
        }
    }

    public static function test(){
        echo 'Hello';
    }

    // 最小文字数チェック

    // 最大文字数チェック

    // メールアドレスチェック

    // 半角英数字チェック

    // アドレス重複チェック

}
