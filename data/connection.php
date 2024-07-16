<?php

$SERVER_NAME = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB_NAME = "db_sig";

$DB = new mysqli($SERVER_NAME, $USERNAME, $PASSWORD);

if ($DB->connect_error) {
    die("Connection Failed: " . $DB->connect_error);
}

$DB_CHECK_QUERY = "SHOW DATABASES LIKE '$DB_NAME'";
$RESULT = $DB->query($DB_CHECK_QUERY);

if ($RESULT->num_rows == 0) {
    $CREATE_DB_QUERY = "CREATE DATABASE $DB_NAME";
    if ($DB->query($CREATE_DB_QUERY) === FALSE) {
        die("Error creating database: " . $DB->connect_error);
    }
}

$DB->select_db($DB_NAME);

function tableExists($DB, $TABLE)
{
    $QUERY = $DB->query("SHOW TABLES LIKE '$TABLE'");
    return $QUERY->num_rows > 0;
}

if (!tableExists($DB, 'users')) {
    $CREATE_TABLE = "
    CREATE TABLE users (
        id int(11) NOT NULL AUTO_INCREMENT,
        username varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY username (username)
    )";
    
    $DB -> query($CREATE_TABLE);
}

if (!tableExists($DB, 'markers')) {
    $CREATE_TABLE = "
    CREATE TABLE markers (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id int(11) NOT NULL,
        lat double NOT NULL,
        lng double NOT NULL,
        name varchar(256) DEFAULT NULL,
        description varchar(256) DEFAULT NULL,
        PRIMARY KEY (id),
        KEY user_id (user_id),
        CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
    )
    ";

    $DB -> query($CREATE_TABLE);
}