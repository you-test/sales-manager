<!-- バリデーションエラー表示 -->
<?php
    if (isset($_SESSION['errors'])) {
        echo '<ul class="alert">';
        foreach ($_SESSION['errors'] as $error) {
            echo  "<li>{$error}</li>";
        }
        echo '</ul>';

        unset($_SESSION['errors']);
    }
?>
<form action="" method="post" class="login-form">
    <div>
        <label for="mail">メールアドレス</label>
        <input type="text" name="mail" id="mail">
    </div>
    <div>
        <label for="password">パスワード</label>
        <input type="text" name="password" id="password">
    </div>
    <button type="submit" class="btn">ログイン</button>
</form>
