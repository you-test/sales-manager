<form action="update.php" method="POST" class="update-form">
    <div>
        <table>
            <tr>
                <td>ユーザーネーム</td>
                <td><input type="text" name="name" value="<?= $userdata['name']; ?>"></td>
            </tr>
            <tr>
                <td>メールアドレス</td>
                <td><input type="text" name="mail" value="<?= $userdata['mail']; ?>"></td>
            </tr>
            <tr>
                <td>パスワード</td>
                <td><input type="text" name="password"></td>
            </tr>
        </table>
        <button type="submit" class="btn">登録</button>
    </div>
</form>
