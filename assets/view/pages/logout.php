<?php
session_start();
session_abort();
header('Location: index.php');
?>