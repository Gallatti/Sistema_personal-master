<?php

session_start();

unset($_SESSION['login_personal_adm']);

header('Location: index.php');