<?php

require"RedBean.php";
R::setup( 'mysql:host=project.loc;dbname=users',
    'mysql', 'mysql' );

session_start();
?>
