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
}
