#ThemeHub


#Description

ThemeHub is a web application designed for managing themes for user interfaces. It provides administrators with the ability to upload new themes, select default themes, and apply them to user interfaces dynamically.
Installation

    Clone this repository to your local machine.
    Set up a web server environment (e.g., XAMPP, WAMP, MAMP).
    Import the provided SQL file (theme_hub.sql) into your MySQL database.
    Update the database connection details in the PHP files (admin.php, user.php, login.php) with your database credentials.
    Ensure that the themes directory has appropriate permissions for file uploads.

Database Details

    Database Name: theme_hub
    Tables:
        settings: Stores settings related to the application, including the selected theme.
            Columns:
                id (Primary Key, Auto Increment)
                selected_theme (VARCHAR)
        themes: Stores information about available themes.
            Columns:
                id (Primary Key, Auto Increment)
                theme_name (VARCHAR)
                theme_file_path (VARCHAR)
        users: Stores user authentication details.
            Columns:
                id (Primary Key, Auto Increment)
                username (VARCHAR)
                password (VARCHAR)

Usage

    Login Page (login.php): Use the login page to authenticate as an admin. Only authenticated users can access the admin panel.
    Admin Panel (admin.php): Access the admin panel to manage themes. Admins can select the default theme, upload new themes, and view available themes.
    User Interface (user.php): Visit the user interface to view the application with the selected theme applied.

Created by

This project was created by @techerrorNR.


Contributions are welcome! Feel free to fork this repository and submit pull requests to suggest improvements or add new features.
License

This project is licensed under the MIT License.
