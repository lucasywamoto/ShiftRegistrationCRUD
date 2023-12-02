CREATE TABLE timesheet (
  workshift_id INT PRIMARY KEY NOT NULL auto_increment,
  employee_name VARCHAR(255) NOT NULL,
  employee_id INT NOT NULL,
  branch VARCHAR(255) NOT NULL,
  shift_date DATE NOT NULL,
  time_in TIME NOT NULL,
  time_out TIME NOT NULL,
  duration TIME NOT NULL
);