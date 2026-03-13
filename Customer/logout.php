<?php

session_start();

/* ลบ session ทั้งหมด */
session_unset();

/* destroy session */
session_destroy();

/* redirect กลับหน้า home */
header("Location: index.php");
exit();