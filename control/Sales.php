<?php

class Sales
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // データの取得
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
    public function register(): void
    {
        require_once 'common/Validation.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $salesDate = $_POST['sales_date'];
            $salesAmount = $_POST['sales_amount'];
            $foodCosts = $_POST['food_costs'];
            $laborCosts = $_POST['labor_costs'];
            $dailyReport = $_POST['daily_report'];
            $_SESSION['errors'] = [];

            // 空文字チェック
            Validation::emptyCheck($_SESSION['errors'], $salesDate, '日付を選択してください。');
            Validation::emptyCheck($_SESSION['errors'], $salesAmount, '売上高を入力してください。');
            Validation::emptyCheck($_SESSION['errors'], $foodCosts, '仕入れを入力してください。');
            Validation::emptyCheck($_SESSION['errors'], $laborCosts, '人件費を入力してください。');
            Validation::emptyCheck($_SESSION['errors'], $dailyReport, '日報を入力してください。');
            // 半角数字チェック
            if (!$_SESSION['errors']) {
                Validation::halfNumberCheck($_SESSION['errors'], $salesAmount, '売上高は半角数字で入力してください。');
                Validation::halfNumberCheck($_SESSION['errors'], $foodCosts, '仕入れは半角数字で入力してください。');
                Validation::halfNumberCheck($_SESSION['errors'], $laborCosts, '人件費は半角数字で入力してください。');
            }
            // 同じ日付のデータ登録かチェック
            if (!$_SESSION['errors']) {
                Validation::duplicateDateCheck($_SESSION['errors'], $salesDate, '既に登録済みの日付です', $this->pdo);
            }

            // エラーがあったらリダイレクト
            if ($_SESSION['errors']) {
                header('Location: register.php');
                exit;
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

    // 日報送信先アドレスの取得

    // 日報の送信
    public function sendDailyReport(array $mails): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_check'])) {
            // 変数の定義
            $mailAddress = [];
            foreach ($mails as $mail) {
                $mailAddress[] = $mail['mail'];
            }
            $mailAddressString = implode(',', $mailAddress);
            $salesDate = $_POST['sales_date'];
            $body = $_POST['daily_report'];

            // エンコーディングの設定
            mb_language("Japanese");
            mb_internal_encoding("UTF-8");

            // 送信処理
            $subject = "{$salesDate}日報";
            $header = 'From: Sales Manager';
            $sendMailResult = mb_send_mail($mailAddressString, $subject, $body, $header);

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
        $statement = $this->pdo->query("SELECT sales_date, sales_amount, food_costs, labor_costs, daily_report FROM sales WHERE id = $id");
        $statement->execute();
        $salesDaily = $statement->fetch();

        $_SESSION['sales_daily'] = $salesDaily['sales_date'];
        $_SESSION['sales_amount'] = $salesDaily['sales_amount'];
        $_SESSION['food_costs'] = $salesDaily['food_costs'];
        $_SESSION['labor_costs'] = $salesDaily['labor_costs'];
        $_SESSION['daily_report'] = $salesDaily['daily_report'];

        return $salesDaily;
    }

    // データの更新
    public function update() {
        require_once 'common/Validation.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $salesDate = $_POST['sales_date'];
            $salesAmount = $_POST['sales_amount'];
            $foodCosts = $_POST['food_costs'];
            $laborCosts = $_POST['labor_costs'];
            $dailyReport = $_POST['daily_report'];
            $_SESSION['errors'] = [];

            // 空文字チェック
            Validation::emptyCheck($_SESSION['errors'], $salesDate, '日付を選択してください。');
            Validation::emptyCheck($_SESSION['errors'], $salesAmount, '売上高を入力してください。');
            Validation::emptyCheck($_SESSION['errors'], $foodCosts, '仕入れを入力してください。');
            Validation::emptyCheck($_SESSION['errors'], $laborCosts, '人件費を入力してください。');
            Validation::emptyCheck($_SESSION['errors'], $dailyReport, '日報を入力してください。');
            // 半角数字チェック
            if (!$_SESSION['errors']) {
                Validation::halfNumberCheck($_SESSION['errors'], $salesAmount, '売上高は半角数字で入力してください。');
                Validation::halfNumberCheck($_SESSION['errors'], $foodCosts, '仕入れは半角数字で入力してください。');
                Validation::halfNumberCheck($_SESSION['errors'], $laborCosts, '人件費は半角数字で入力してください。');
            }

            // エラーがあったらリダイレクト
            if ($_SESSION['errors']) {
                header('Location: fix.php');
                exit;
            }

            $statement = $this->pdo->prepare("UPDATE sales SET sales_amount = :sales_amount, food_costs = :food_costs, labor_costs = :labor_costs, daily_report = :daily_report WHERE sales_date = :sales_date");
            $statement->bindValue('sales_amount', $salesAmount);
            $statement->bindValue('food_costs', $foodCosts);
            $statement->bindValue('labor_costs', $laborCosts);
            $statement->bindValue('sales_date', $salesDate);
            $statement->bindValue('daily_report', $dailyReport);
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
