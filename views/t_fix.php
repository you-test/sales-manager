<form method="POST" class="fix-form">
    <div>
        <table>
            <tr>
                <td>日付</td>
                <td><?= $sales_daily['sales_date']; ?></td>
                <input type="hidden" name="sales_date" value="<?= $_SESSION['sales_daily']; ?>">
            </tr>
            <tr>
                <td>売上高</td>
                <td><input type="text" name="sales_amount" value="<?= $_SESSION['sales_amount']; ?>"></td>
            </tr>
            <tr>
                <td>仕入れ</td>
                <td><input type="text" name="food_costs" value="<?= $_SESSION['food_costs']; ?>"></td>
            </tr>
            <tr>
                <td>人件費</td>
                <td><input type="text" name="labor_costs" value="<?= $_SESSION['labor_costs']; ?>"></td>
            </tr>
            <tr>
                <td>日報</td>
                <td>
                    <textarea name="daily_report" id="daily-report" cols="30" rows="10"><?= $_SESSION['daily_report'] ?></textarea>
                </td>
            </tr>
        </table>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="checkbox" name="send_check" id="send-check" value="true">
        <label for="send-check">日報を送信する</label>
        <button type="submit" formaction="update.php" class="btn">更新</button>
        <button type="submit" formaction="delete.php" class="btn">削除</button>
    </div>
</form>
