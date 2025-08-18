-- สร้างฐานข้อมูล (ปรับชื่อ/สิทธิ์ตามเครื่องของคุณ)
CREATE DATABASE IF NOT EXISTS employees_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE employees_db;

-- ตารางแผนก (departments)
DROP TABLE IF EXISTS departments;
CREATE TABLE departments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name_th VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ตารางพนักงาน (employees)
DROP TABLE IF EXISTS employees;
CREATE TABLE employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  emp_code VARCHAR(20) NOT NULL,          -- รหัสพนักงาน
  fullname_th VARCHAR(150) NOT NULL,      -- ชื่อ-นามสกุล (ไทย)
  email VARCHAR(150) NULL,
  phone VARCHAR(50) NULL,
  dept_id INT NOT NULL,                    -- อ้างอิงไปยัง departments.id
  salary DECIMAL(12,2) NOT NULL DEFAULT 0, -- เงินเดือน
  hired_at DATE NOT NULL,                  -- วันที่เริ่มงาน
  CONSTRAINT fk_emp_dept FOREIGN KEY (dept_id) REFERENCES departments(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ข้อมูลตัวอย่างแผนก (ภาษาไทย)
INSERT INTO departments (name_th) VALUES
('ฝ่ายทรัพยากรบุคคล'),
('ฝ่ายเทคโนโลยีสารสนเทศ'),
('ฝ่ายบัญชีและการเงิน'),
('ฝ่ายขายและการตลาด'),
('ฝ่ายผลิต');

-- ข้อมูลตัวอย่างพนักงาน (ภาษาไทย)
INSERT INTO employees (emp_code, fullname_th, email, phone, dept_id, salary, hired_at) VALUES
('EMP001', 'ก้องภพ อินทร์ทอง', 'kongpop@example.com', '081-111-2222', 2, 38000.00, '2023-03-01'),
('EMP002', 'ศิรินาถ ชื่นใจ', 'sirinart@example.com', '082-333-4444', 1, 32000.00, '2024-01-15'),
('EMP003', 'วิทยา สมบูรณ์', 'withaya@example.com', '083-555-6666', 5, 29000.00, '2022-10-10');
