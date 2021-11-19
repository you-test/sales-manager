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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $month_array = explode('-', $_POST['month']);
            $month = implode($month_array);

            $statement = $this->pdo->query("SELECT * FROM sales WHERE DATE_FORMAT(sales_date, '%Y%m') = {$month} ORDER BY sales_date ASC");
            $statement->execute();
            $sales_data = $statement->fetchAll();

            return $sales_data;
        }
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
}
