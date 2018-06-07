<?php
// for dev purpose
error_reporting(E_ALL);
ini_set('display_errors', 1);

// set locale for date labels
setlocale(LC_TIME, 'NL_nl');

// Require the class
require './simplephpcalendar.php';
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <style>
      body { font-family: 'Open Sans', sans-serif; background: #efeff2; padding: 40px; }
      hr { margin: 40px;}
      .spc__table, .spc__table th, .spc__table td { box-sizing: border-box; }
      .spc__table { padding: 8px; background: #fff; box-shadow: 0px 0px 32px 0px rgba(0,0,0,0.2); }
      .spc__table a { color: #444; text-decoration: none;}
      .spc__table th.spc__table__day { color:#999; font-size: 0.8em; font-weight: normal;}
      .spc__table td.spc__table__day { width:32px; height:32px; background: #dde; text-align: center; font-size: 0.8em; padding: 4px;}
      .spc__table td.spc__table__today { border: 2px solid #00a; color:#000; }
      .spc__table td.spc__table__selected { background:#00a; font-weight: 700; }
      .spc__table td.spc__table__selected a { color:#fff; }

      /* second calendar collection */
      .spc__table.year-cal { box-shadow: none; }
      .spc__table.year-cal td.spc__table__today { background: #777; color:#fff; border: none;}
      .spc__table.year-cal td.spc__table__day { width:24px; height:24px; background: #dde; text-align: center; font-size: 0.7em; padding: 4px;}
      .spc__table.year-cal td.spc__table__today { background: #777; color:#fff; }
      .spc__table.year-cal td.spc__table__selected { background:#000; font-weight: 700; }
      .spc__table.year-cal td.spc__table__selected a { color:#fff; }
    </style>
  </head>
  <body>

    <?php
    // instantiate calendar with options
    $cal = new JF\SimplePHPCalendar([
      "link"              => 'index.php',
      "monthname_format"  => '%B', // default
      "daylabel_format"   => '%a', // default
      "date_param"        => 'date',
    ]);

    // Draw the calendar
    $cal->draw();
    ?>

    <hr>

    <?php
    // example draw multiple calendars with containing class
    for ($m=1; $m<=12; $m++) {
      // instantiate
      $cal = new JF\SimplePHPCalendar([
          "link"              => 'index.php',
          "monthname_format"  => '%B', // default
          "daylabel_format"   => '%a', // default
          "date_param"        => 'date',
          "class_names"       => 'year-cal',
          "style_today"       => FALSE,
        ],
        "2018-".str_pad($m, 2, "0", STR_PAD_LEFT)
      );

      // draw it
      $cal->draw();
    }
    ?>

  </body>
</html>
