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
        $sales_data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $month_array = explode('-', $_POST['month']);
            $month = implode($month_array);

            $statement = $this->pdo->query("SELECT * FROM sales WHERE DATE_FORMAT(sales_date, '%Y%m') = $month ORDER BY sales_date ASC");
            $statement->execute();
            $sales_data = $statement->fetchAll();
        }

        return $sales_data;
    }

    // 累計値取得
    public function totalSalesShow($sales_data)
    {
        $totalSum = [
            'sales' => 0,
            'food' => 0,
            'labor' => 0,
        ];

        for ($i = 0; $i < count($sales_data); $i++) {
            $totalSum['sales'] += $sales_data[$i]['sales_amount'];
            $totalSum['food'] += $sales_data[$i]['food_costs'];
            $totalSum['labor'] += $sales_data[$i]['labor_costs'];
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
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sales_date = $_POST['sales_date'];
            $sales_amount = $_POST['sales_amount'];
            $food_costs = $_POST['food_costs'];
            $labor_costs = $_POST['labor_costs'];

            if ($sales_date === '') {
                return '日付を選択してください。';
            }

            $statement = $this->pdo->prepare("INSERT INTO sales (sales_date, sales_amount, food_costs, labor_costs) VALUES (:sales_date, :sales_amount, :food_costs, :labor_costs)");
            $statement->bindValue('sales_date', $sales_date);
            $statement->bindValue('sales_amount', $sales_amount);
            $statement->bindValue('food_costs', $food_costs);
            $statement->bindValue('labor_costs', $labor_costs);
            $statement->execute();

        }
    }

    // データ更新画面の既存データ取得
    public function showUpdate($id) {
        $statement = $this->pdo->query("SELECT sales_date, sales_amount, food_costs, labor_costs FROM sales WHERE id = $id");
        $statement->execute();
        $sales_daily = $statement->fetch();

        return $sales_daily;
    }

    // データの更新
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sales_date = $_POST['sales_date'];
            $sales_amount = $_POST['sales_amount'];
            $food_costs = $_POST['food_costs'];
            $labor_costs = $_POST['labor_costs'];

            $statement = $this->pdo->prepare("UPDATE sales SET sales_amount = :sales_amount, food_costs = :food_costs, labor_costs = :labor_costs WHERE sales_date = :sales_date");
            $statement->bindValue('sales_amount', $sales_amount);
            $statement->bindValue('food_costs', $food_costs);
            $statement->bindValue('labor_costs', $labor_costs);
            $statement->bindValue('sales_date', $sales_date);
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
