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
      div.year-container {}
      div.year-container::after { clear:both; display:block; content:""; }
      div.year-container div.cal { margin: 0.5px; padding:0; list-style: none; float:left;}
      .spc__year, .spc__year th, .spc__year td { box-sizing: border-box; }
      .spc__year { padding: 8px; box-shadow: none; min-height: 240px; background: #111; color:#555;}
      .spc__year a { color: #666; text-decoration: none;}
      .spc__year th.spc__year__day { font-size:0.8em; font-weight: normal;}
      .spc__year td.spc__year__day { width:30px; height:20px; background: #333; text-align: center; font-size: 0.7em; padding: 4px;}
      .spc__year td.spc__year__today { background: #555;}
      .spc__year td.spc__year__today a { color:#ccc; font-weight: 700;}
      .spc__year td.spc__year__selected { border: 2px solid #800; background:#a00;  }
      .spc__year td.spc__year__selected a { color: #c77; font-weight: 700; }
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
    <div class="year-container">
    <?php
    // example draw multiple calendars with containing class
    for ($m=1; $m<=12; $m++) {
      // instantiate
      $cal = new JF\SimplePHPCalendar([
          "link"              => 'index.php',
          "monthname_format"  => '%B', // default
          "daylabel_format"   => '%a', // default
          "date_param"        => 'date',
          "enclosing"         => ['<div class="cal">', '</div>'],
          "class_name"       => 'spc__year',
          "style_today"       => TRUE,
        ],
        "2018-".str_pad($m, 2, "0", STR_PAD_LEFT)
      );

      // draw it
      $cal->draw();
    }
    ?>
  </div>

  </body>
</html>
