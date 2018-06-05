<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Require the class
 */
require './simplephpcalendar.php';

/**
 * Instantiate a calendar object
 */
$the_date = isset($_GET["d"]) ? $_GET["d"] : date('Y-m-d');
$cal = new JF\SimplePHPCalendar( $the_date );
$cal->link = 'index.php';
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <style>
      body { font-family: 'Open Sans', sans-serif; }
      table.calendar a { color: #444; }
      table.calendar td.today = { font-weight: 700; }
    </style>
  </head>
  <body>
    <?php
    /**
     * Draw the calendar
     */
    $cal->draw();
    ?>
  </body>
</html>
