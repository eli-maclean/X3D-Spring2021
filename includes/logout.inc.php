<?php
//Just a basic logout and closing of the session.
session_start();
session_unset();
session_destroy();
header("Location: ../feedback.php");
