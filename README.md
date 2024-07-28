# Simple Blog Setup

## Prerequisites

- PHP >= 7.4
- MySQL
- Apache/Nginx
- Composer (optional for additional packages)

## Installation

1. **Clone the repository**:

   ```sh
   git clone https://github.com/robertsonmorales/simple-blog.git
   cd simple-blog
   ```

2. **Create a database**:

```sh
CREATE DATABASE blog_db;
USE blog_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
   id INT AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(255) NOT NULL,
   content TEXT NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comments (
   id INT AUTO_INCREMENT PRIMARY KEY,
   post_id INT,
   username VARCHAR(255) NOT NULL,
   comment TEXT NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);
```

3. **Update database configuration in config.php**:

4. **Start the server**:
   Place the project folder in your web server's root directory and start the server.

5. **Access the blog**:
   Open your browser and navigate to http://localhost/simple-blog.

6. **Admin functionalities**:
   To add/edit/delete comments as an admin, you can use the following scripts:
   submit_comment.php
   admin/admin_edit_comment.php
   admin/admin_delete_comment.php

7. **Seeder**:
   Open your browser and navigate to http://localhost/seed/blog_seeder.php
   and http://localhost/seed/user_seeder.php

This guide sets up a blog with public and admin functionalities using PHP, MySQL, Bootstrap, and jQuery. For a production environment, consider adding proper authentication, validation, and security measures.
