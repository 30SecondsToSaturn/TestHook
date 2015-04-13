#!/bin/bash
mysql -u root -p << EOF

DB_NAME = "bitprove_webhook";
DB_USER = "bitprove";
BITPROVE_PW = "password";

CREATE DATABASE $DB_NAME;

GRANT ALL PRIVILEGES
ON $DB_NAME.*
TO '$DB_USER'@'localhost'
IDENTIFIED BY '$BITPROVE_PW'
WITH GRANT OPTION;

use $DB_NAME;

$webhook_feat = "webhook_feat"
CREATE TABLE $webhook_feat (
   id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   priority TINYINT NOT NULL,
   url TEXT NOT NULL,
   title VARCHAR(255),
   number INT UNSIGNED NOT NULL,
   branch VARCHAR(255)
);

EOF
