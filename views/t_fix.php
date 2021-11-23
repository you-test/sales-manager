<form method="POST">
    <table>
        <tr>
            <td>日付</td>
            <td><?= $sales_daily['sales_date']; ?></td>
            <input type="hidden" name="sales_date" value="<?= $sales_daily['sales_date']; ?>">
        </tr>
        <tr>
            <td>売上高</td>
            <td><input type="text" name="sales_amount" value="<?= $sales_daily['sales_amount']; ?>"></td>
        </tr>
        <tr>
            <td>仕入れ</td>
            <td><input type="text" name="food_costs" value="<?= $sales_daily['food_costs']; ?>"></td>
        </tr>
        <tr>
            <td>人件費</td>
            <td><input type="text" name="labor_costs" value="<?= $sales_daily['labor_costs']; ?>"></td>
        </tr>
    </table>
    <input type="hidden" name="id" value="<?= $id ?>">
    <button type="submit" formaction="update.php">更新</button>
    <button type="submit" formaction="delete.php">削除</button>
</form>
