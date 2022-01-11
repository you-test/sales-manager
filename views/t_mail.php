<div class="mail-list-wrapper">
    <form action="mail.php" method="POST">
        <input type="hidden" name="new_mail" value="">
        <button type="submit" class="btn">アドレス追加</button>
    </form>

    <table>
        <?php foreach ($mails as $mail): ?>
            <tr>
                <form action="mail_delete.php" method="POST">
                    <td><input type="text" name="mail[]" value="<?= $mail['mail'] ?>" form="all-mail"></td>
                    <input type="hidden" name="id[]" value="<?= $mail['id'] ?>" form="all-mail">
                    <input type="hidden" name="id" value="<?= $mail['id'] ?>">
                    <td><button type="submit">x</button></td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
    <form action="mail.php" method="POST" id="all-mail">
        <button type="submit" class="btn">データの登録</button>
    </form>
</div>
