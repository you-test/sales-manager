<div class="select-term">
    <form action="" method="POST">
        <label for="month">期間選択</label>
        <input type="month" name="month" id="month">
        <button>test</button>
    </form>
</div>
<a href="register.php">新規登録</a>
<table>
    <thead>
        <tr>
            <th>日付</th>
            <th>売上</th>
            <th>仕入れ</th>
            <th>人件費</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sales_data as $sales_daily): ?>
            <tr>
                <th><?= $sales_daily['sales_date']; ?></th>
                <th><?= number_format($sales_daily['sales_amount']); ?></th>
                <th><?= number_format($sales_daily['food_costs']); ?></th>
                <th><?= number_format($sales_daily['labor_costs']); ?></th>
                <th>
                    <a href="<?PHP echo 'update.php?id=' . $sales_daily['id']; ?>">修正</a>
                    <a href="delete.php">削除</a>
                </th>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>累計売上</th>
            <th>累計仕入れ</th>
            <th>累計人件費</th>
        </tr>
        <tr>
            <th></th>
            <th><?= number_format($totalSum['sales']); ?></th>
            <th><?= number_format($totalSum['food']); ?></th>
            <th><?= number_format($totalSum['labor']); ?></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>原価率</th>
            <th>人件費率</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th><?= $fRatio ?>%</th>
            <th><?= $lRatio ?>%</th>
        </tr>
    </tfoot>
</table>
