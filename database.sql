-- データベース作成
CREATE DATABASE sales_manager DEFAULT CHARACTER SET utf8mb4;

-- テーブル作成(users)
CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  mail VARCHAR(255),
  password TEXT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET=utf8mb4;

-- テーブル作成(sales)
CREATE TABLE sales (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  sales_date DATE NOT NULL,
  sales_amount BIGINT,
  food_costs BIGINT,
  labor_costs BIGINT
) DEFAULT CHARACTER SET=utf8mb4;

-- テーブル作成(sendreport_adress)
CREATE TABLE sendreport_adress (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  mail VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET=utf8mb4;

-- カラム変更・追加
ALTER TABLE users ADD updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE sales ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE sales ADD updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- 日報本文カラムの追加
ALTER TABLE sales ADD daily_report VARCHAR(1000) AFTER labor_costs;
