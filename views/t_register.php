<form action="register.php" method="POST" class="register-form">
    <table>
        <tr>
            <th>日付</th>
            <th><input type="date" name="sales_date"></th>
        </tr>
        <tr>
            <th>売上高</th>
            <th><input type="text" name="sales_amount"></th>
        </tr>
        <tr>
            <th>仕入れ</th>
            <th><input type="text" name="food_costs"></th>
        </tr>
        <tr>
            <th>人件費</th>
            <th><input type="text" name="labor_costs"></th>
        </tr>
    </table>
    <button type="submit" class="btn">データの登録</button>
</form>
