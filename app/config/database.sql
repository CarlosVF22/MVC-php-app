CREATE TABLE Branch (
code INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL
);

CREATE TABLE Element (
code INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL
);

CREATE TABLE Technician (
code INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
base_salary DECIMAL(10,2) NOT NULL,
branch_code INT,
FOREIGN KEY (branch_code) REFERENCES Branch(code)
);

CREATE TABLE Technician_Element (
technician_code INT,
element_code INT,
quantity INT CHECK (quantity BETWEEN 1 AND 10),
PRIMARY KEY (technician_code, element_code),
FOREIGN KEY (technician_code) REFERENCES Technician(code) ON DELETE CASCADE,
FOREIGN KEY (element_code) REFERENCES Element(code) ON DELETE CASCADE
);