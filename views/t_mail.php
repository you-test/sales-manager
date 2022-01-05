<form action="mail.php" method="POST">
    <input type="hidden" name="new_mail" value="メールアドレスを入力してください。">
    <button type="submit" class="btn">アドレス追加</button>
</form>
<form action="mail.php" method="POST" class="register-form">
    <div>
        <table>
            <?php foreach ($mails as $mail): ?>
                <tr>
                    <td><?= $mail['id'] ?></td>
                    <td><input type="text" name="mail[]" value="<?= $mail['mail'] ?>"></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit" class="btn">データの登録</button>
    </div>
</form>
