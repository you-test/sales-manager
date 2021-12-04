<a href="register.php">新規登録</a>
<div class="list-wrapper">
    <table>
        <thead>
            <tr class="table-title">
                <th>ID</th>
                <th>ユーザーネーム</th>
                <th>メールアドレス</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersdata as $userdata): ?>
                <tr>
                    <td><?= $userdata['id']; ?></td>
                    <td><?= $userdata['name']; ?></td>
                    <td><?= $userdata['mail']; ?></td>
                    <td>
                        <form method="GET">
                            <input type="hidden" name="id" value="<?= $userdata['id']; ?>">
                            <button type="submit" formaction="update.php">更新</button>
                            <button type="submit" formaction="delete.php">削除</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
