<div class="select-term">
    <form action="" method="POST">
        <label for="month">期間選択</label>
        <input type="month" name="month" id="month">
        <button>表示</button>
    </form>
    <a href="register.php" class="register-link">新規登録</a>
</div>
<div class="list-wrapper">
    <table class="table-grey">
        <thead>
            <tr class="table-title">
                <th>日付</th>
                <th>売上</th>
                <th>仕入れ</th>
                <th>人件費</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales_data as $sales_daily): ?>
                <tr>
                    <th  class="table-date"><?= $sales_daily['sales_date']; ?></th>
                    <th class="table-white"><?= number_format($sales_daily['sales_amount']); ?></th>
                    <th class="table-white"><?= number_format($sales_daily['food_costs']); ?></th>
                    <th class="table-white"><?= number_format($sales_daily['labor_costs']); ?></th>
                    <th class="table-white">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $sales_daily['id']; ?>">
                            <button type="submit" formaction="fix.php">更新</button>
                            <button type="submit" formaction="delete.php">削除</button>
                        </form>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="table-title">
                <th></th>
                <th>累計売上</th>
                <th>累計仕入れ</th>
                <th>累計人件費</th>
            </tr>
            <tr>
                <th></th>
                <th class="table-white"><?= number_format($totalSum['sales']); ?></th>
                <th class="table-white"><?= number_format($totalSum['food']); ?></th>
                <th class="table-white"><?= number_format($totalSum['labor']); ?></th>
            </tr>
            <tr class="table-title">
                <th></th>
                <th></th>
                <th>原価率</th>
                <th>人件費率</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th class="table-white"><?= $fRatio ?>%</th>
                <th class="table-white"><?= $lRatio ?>%</th>
            </tr>
        </tfoot>
    </table>
</div>
