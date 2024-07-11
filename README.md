
# WCF Coding Challenge

This project is a web application for managing patient forms with a focus on Neuro Modulation. The project uses PHP, IIS, and SQL Server.

## Prerequisites

- PHP 8.3
- IIS (Internet Information Services)
- SQL Server 2022 (Express)
- Git

## Installation and Configuration

### 1. Install PHP

Download and install PHP version 8.3 from the official PHP website. Make sure to add PHP to your system's PATH environment variable.

### 2. Configure PHP in IIS

1. Open IIS Manager.
2. In the Connections pane, expand the node for your computer and click on `Sites`.
3. Click on `Add Website...`.
4. Set the `Site name`, `Physical path` to the root of your project.

### 3. Install SQL Server 2022 (Express)

Download and install SQL Server 2022 Express from the official Microsoft website. Make sure to configure it with a named instance and allow remote connections.

### 4. Download the Project

Clone the project from GitHub:

```bash
git clone https://github.com/Haripriya-chalil/WCF_Coding_Challenge.git
```

### 5. Import the Database

1. Open SQL Server Management Studio (SSMS).
2. Connect to your SQL Server instance.
3. Open the `WCFT-Coding-Challenge/Database/database.sql` file.
4. Execute the script to create the database, tables,stored procedures.

### 6. Configure Environment Variables

Create a `.env` file in the root of your project and add the following content:

```
BASE_URL=http://localhost/WCF-Coding-Challenge/views
DB_SERVERNAME= Your Server Name
DB_DATABASE=Your Database Name
DB_USERNAME=Your Database Username
DB_PASSWORD=Your Database Password
```

## Accessing the Application

### Patient Form (Neuro Modulation)

To access the patient form for Neuro Modulation, open any browser and type:

```
http://localhost/WCF-Coding-Challenge/views/patient_form.php
```

### Admin Home

To access the admin home page, open any browser and type:

```
http://localhost/WCF-Coding-Challenge/views/admin_home.php
```

### Adding Admin User

To add an admin user to the `users` table, you can use SQL Server Management Studio (SSMS) or any other SQL query tool to insert a new user record into the `users` table.

```sql
INSERT INTO users (username, password) VALUES ('admin@twcnft.com', '$2y$10$aat23OuYEYdScQtoYj0AO.FCBXmf5MuvOmh5fi5y.TSaKGHaF16QS');
```
Replace `'your_password'` with a secure password of your choice.

### Adding Questions

To add question to the `question` table, you can use SQL Server Management Studio (SSMS) or any other SQL query tool to insert question  into the `question` table.

```sql
INSERT INTO question (id, category, description, max_score) VALUES
(1, 'Brief Pain Inventory (BPI)', 'How much relief have pain treatments or medications FROM THIS CLINIC provided?', 100),
(2, 'Brief Pain Inventory (BPI)', 'Please rate your pain based on the number that best describes your pain at its WORST in the past week.', 10),
(3, 'Brief Pain Inventory (BPI)', 'Please rate your pain based on the number that best describes your pain at its LEAST in the past week.', 10),
(4, 'Brief Pain Inventory (BPI)', 'Please rate your pain based on the number that best describes your pain on the Average.', 10),
(5, 'Brief Pain Inventory (BPI)', 'Please rate your pain based on the number that best describes your pain that tells how much pain you have RIGHT NOW.', 10),
(6, 'Brief Pain Inventory (BPI)', 'Based on the number that best describes how during the past week pain has INTERFERED with your: General Activity.', 10),
(7, 'Brief Pain Inventory (BPI)', 'Based on the number that best describes how during the past week pain has INTERFERED with your: Mood.', 10),
(8, 'Brief Pain Inventory (BPI)', 'Based on the number that best describes how during the past week pain has INTERFERED with your: Walking ability.', 10),
(9, 'Brief Pain Inventory (BPI)', 'Based on the number that best describes how during the past week pain has INTERFERED with your: Normal work (includes work both outside the home and housework).', 10),
(10, 'Brief Pain Inventory (BPI)', 'Based on the number that best describes how during the past week pain has INTERFERED with your: Relationships with other people.', 10),
(11, 'Brief Pain Inventory (BPI)', 'Based on the number that best describes how during the past week pain has INTERFERED with your: Sleep.', 10),
(12, 'Brief Pain Inventory (BPI)', 'Based on the number that best describes how during the past week pain has INTERFERED with your: Enjoyment of life.', 10);
```



