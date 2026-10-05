<?php

// Logout page - clears session and redirects to index
session_start();
session_destroy();
header("Location: index.php");
exit();