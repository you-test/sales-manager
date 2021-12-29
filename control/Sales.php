<?php

class Sales
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // データの表示
    public function showSales()
    {
        $salesData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $montArray = explode('-', $_POST['month']);
            $month = implode($montArray);

            if (empty($month)) {
                $salesData = [];
            } else {
                $statement = $this->pdo->query("SELECT * FROM sales WHERE DATE_FORMAT(sales_date, '%Y%m') = $month ORDER BY sales_date ASC");
                $statement->execute();
                $salesData = $statement->fetchAll();
            }
        }

        return $salesData;
    }

    // 累計値取得
    public function totalSalesShow($salesData)
    {
        $totalSum = [
            'sales' => 0,
            'food' => 0,
            'labor' => 0,
        ];

        for ($i = 0; $i < count($salesData); $i++) {
            $totalSum['sales'] += $salesData[$i]['sales_amount'];
            $totalSum['food'] += $salesData[$i]['food_costs'];
            $totalSum['labor'] += $salesData[$i]['labor_costs'];
        }

        return $totalSum;
    }

    // 原価率・人件費計算
    public function flRatio($totalSum) {
        if (!isset($totalSum) || $totalSum['sales'] === 0) {
            $fRatio = '-';
            $lRatio = '-';
            return array($fRatio, $lRatio);
        }

        $fRatio = round(($totalSum['food'] / $totalSum['sales']) * 100, 1);
        $lRatio = round(($totalSum['labor'] / $totalSum['sales']) * 100, 1);

        return array($fRatio, $lRatio);
    }

    // データの新規登録
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $salesDate = $_POST['sales_date'];
            $salesAmount = $_POST['sales_amount'];
            $foodCosts = $_POST['food_costs'];
            $laborCosts = $_POST['labor_costs'];
            $dailyReport = $_POST['daily_report'];

            if ($salesDate === '') {
                return '日付を選択してください。';
            }

            $statement = $this->pdo->prepare("INSERT INTO sales (sales_date, sales_amount, food_costs, labor_costs, daily_report) VALUES (:sales_date, :sales_amount, :food_costs, :labor_costs, :daily_report)");
            $statement->bindValue('sales_date', $salesDate);
            $statement->bindValue('sales_amount', $salesAmount);
            $statement->bindValue('food_costs', $foodCosts);
            $statement->bindValue('labor_costs', $laborCosts);
            $statement->bindValue('daily_report', $dailyReport);
            $statement->execute();

        }
    }

    // 日報の送信
    public function sendDailyReport()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_check'])) {
            // 変数の定義
            $mailAdress = '';
            $salesDate = $_POST['sales_date'];
            $body = $_POST['daily_report'];

            // エンコーディングの設定
            mb_language("Japanese");
            mb_internal_encoding("UTF-8");

            // 送信処理
            $mailAdress = 'yusuke.page2021@gmail.com';
            $subject = "{$salesDate}日報";
            $header = 'From: Sales Manager';
            $sendMailResult = mb_send_mail($mailAdress, $subject, $body, $header);

            // 送信結果の表示
            if ($sendMailResult) {
                echo '日報が送信されました。';
            } else {
                echo '日報の送信に失敗しました。';
            }
        }
    }

    // データ更新画面の既存データ取得
    public function showUpdate($id) {
        $statement = $this->pdo->query("SELECT sales_date, sales_amount, food_costs, labor_costs FROM sales WHERE id = $id");
        $statement->execute();
        $salesDaily = $statement->fetch();

        return $salesDaily;
    }

    // データの更新
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $salesDate = $_POST['sales_date'];
            $salesAmount = $_POST['sales_amount'];
            $foodCosts = $_POST['food_costs'];
            $laborCosts = $_POST['labor_costs'];

            $statement = $this->pdo->prepare("UPDATE sales SET sales_amount = :sales_amount, food_costs = :food_costs, labor_costs = :labor_costs WHERE sales_date = :sales_date");
            $statement->bindValue('sales_amount', $salesAmount);
            $statement->bindValue('food_costs', $foodCosts);
            $statement->bindValue('labor_costs', $laborCosts);
            $statement->bindValue('sales_date', $salesDate);
            $statement->execute();

            header('Location: list.php');
        }
    }

    // データの削除
    public function delete($id) {
        $statement = $this->pdo->query("DELETE FROM sales WHERE id = $id");
        $statement->execute();

        header('Location: list.php');
    }
}
