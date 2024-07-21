# PHP eCommerce Application

THis is PHP eCommerce application designed to run on Apache server with XAMPP.

## Setup Instructions

### 1. Install XAMPP

1. Download [XAMPP](https://www.apachefriends.org/index.html) for your operating system.
2. Install XAMPP following the installation instructions for your platform.
3. Start Apache and MySQL modules from the XAMPP Control Panel.

### 2. Setup Database

1. Open your web browser and go to `http://localhost/phpmyadmin`.
2. Log in to phpMyAdmin (default credentials are usually `root` for username and no password).
3. Create a new database named `shop_db`.

### 3. Import SQL Script

1. Find the SQL script file (`shop_db.sql`) in the project directory.
2. Open phpMyAdmin and select the `shop_db` database.
3. Click on the `Import` tab in phpMyAdmin.
4. Click on `Choose File` and select the `database.sql` file from your project directory.
5. Leave all other settings as default and click on `Go` to import the SQL script into your `shop_db` database.

### 4. Deploying the Application

1. Clone this repository to your local machine or download the ZIP file and extract it.
2. Copy the repository files to the XAMPP `htdocs` directory. For example, if XAMPP is installed in `C:\xampp`, copy the files to `C:\xampp\htdocs\projectdirectory`.

### 5. Accessing Dashboards

- **User Dashboard**: Open your web browser and go to `http://localhost/projectdirectory/user`.
- **Admin Dashboard**: Open your web browser and go to `http://localhost/projectdirectory/admin`.


*By following these instructions, you should be able to set up and run the PHP eCommerce application on your local machine using XAMPP with Apache server.*
