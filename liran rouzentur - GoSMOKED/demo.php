<?php

$hash_pass = password_hash('123456',PASSWORD_BCRYPT);
echo $hash_pass;