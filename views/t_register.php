<form action="register.php" method="POST" class="register-form">
    <div>
        <table>
            <tr>
                <td>日付</td>
                <td><input type="date" name="sales_date"></td>
            </tr>
            <tr>
                <td>売上高</td>
                <td><input type="text" name="sales_amount"></td>
            </tr>
            <tr>
                <td>仕入れ</td>
                <td><input type="text" name="food_costs"></td>
            </tr>
            <tr>
                <td>人件費</td>
                <td><input type="text" name="labor_costs"></td>
            </tr>
            <tr>
                <td>日報</td>
                <td>
                    <textarea name="daily_report" id="daily-report" cols="30" rows="10"></textarea>
                </td>
            </tr>
        </table>
        <input type="checkbox" name="send_check" id="send-check" value="true">
        <label for="send-check">日報を送信する</label>
        <button type="submit" class="btn">データの登録</button>
    </div>
</form>
