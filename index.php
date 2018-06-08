<?php
// for dev purpose
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Require the class
require './simplephpcalendar.php';
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Cabin:700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <style>
      body { font-family: 'Open Sans', sans-serif; background: #efeff2; padding: 40px; }
      hr { margin: 40px;}
    </style>
  </head>
  <body>


    <?php
    /**
     * EXAMPLE 1
     */
    ?>
    <style>
      .spc__table, .spc__table th, .spc__table td { box-sizing: border-box; }
      .spc__table__container { display: inline-block; position: relative;}
      .spc__table__container a.spc__table__ctrl { position: absolute; text-decoration: none; color: #444;}
      .spc__table__container a.spc__table__ctrl-l { left:12px; top:12px; }
      .spc__table__container a.spc__table__ctrl-r { right:12px; top:12px; }
      .spc__table { padding: 8px; background: #fff; box-shadow: 0px 0px 32px 0px rgba(0,0,0,0.2); }
      .spc__table a { color: #444; text-decoration: none;}
      .spc__table th.spc__table__day { color:#999; font-size: 0.8em; font-weight: normal;}
      .spc__table td.spc__table__day { width:32px; height:32px; background: #dde; text-align: center; font-size: 0.8em; padding: 4px;}
      .spc__table td.spc__table__today { background: #88e; }
      .spc__table td.spc__table__today a { color:#ddf; }
      .spc__table td.spc__table__selected { background:#00a; font-weight: 700; }
      .spc__table td.spc__table__selected a { color:#fff; }
    </style>
    <?php
    // set locale
    setlocale(LC_TIME, 'en_US.UTF-8');
    // instantiate calendar with options
    $cal = new JF\UI\SimplePHPCalendar([
      "link"              => '', // default
      "monthname_format"  => '%B', // default
      "daylabel_format"   => '%a', // default
      "date_param"        => 'd', // default
      "nav_left"          => '<i class="fas fa-angle-left"></i>', // fontawesome!
      "nav_right"         => '<i class="fas fa-angle-right"></i>', // fontawesome!
    ]);

    // Draw the calendar
    $cal->draw();
    ?>


    <hr>


    <?php
    /**
    * EXAMPLE 2
    */
    ?>
    <div class="example2-holder">
      <style>
        div.example2-holder {}
        div.example2-holder::after { clear:both; display:block; content:""; }
        div.example2-holder div.example2__container { margin: 0.5px; padding:0; list-style: none; float:left;}
        .example2, .example2 th, .example2 td, .example2 div { box-sizing: border-box; }
        .example2 { padding: 8px; min-height: 240px; background: #111; color:#555;}
        .example2 a { color: #666; text-decoration: none;}
        .example2 th.example2__title { font-size:0.8em; font-weight: normal; font-style: italic;}
        .example2 th.example2__day { font-size:0.8em; font-weight: normal;}
        .example2 td.example2__day { width:14.3%; height:24px; background: #333; text-align: center; font-size: 0.7em;}
        .example2 td.example2__today { background: #555;}
        .example2 td.example2__today a { color:#ccc; font-weight: 700;}
        .example2 td.example2__selected { border: 2px solid #800; background:#a00;  }
        .example2 td.example2__selected a { color: #c77; font-weight: 700; }
      </style>
      <?php
      // set different locale
      setlocale(LC_TIME, 'ES_es');
      // example draw multiple calendars within containing class
      for ($m=1; $m<=12; $m++) {
        // instantiate
        $cal = new JF\UI\SimplePHPCalendar([
            "link"              => 'index.php',
            "monthname_format"  => '%b', // default
            "daylabel_format"   => '%a', // default
            "date_param"        => 'date',
            "class_name"        => 'example2',
            "style_today"       => TRUE,
            "style_selected"    => TRUE,
            "show_navigation"   => FALSE,
          ],
          "2018-".str_pad($m, 2, "0", STR_PAD_LEFT)
        );

        // draw it
        $cal->draw();
      }
      ?>
    </div>


    <hr>


    <?php
    /**
     * EXAMPLE 3
     */
    ?>
    <style>
      .example3__container { font-family: 'Cabin', sans-serif; font-weight: 700; }
      .example3, .example3 th, .example3 td, .example3 div { box-sizing: border-box; }
      .example3 { padding: 8px; width:600px; min-height: 340px; border: 4px solid #000; border-radius: 6px; background: #ff0; color:#000;}
      .example3 a { color: #666; text-decoration: none;}
      .example3 th.example3__title { font-size:3em; text-transform: uppercase;}
      .example3 th.example3__day { width:14.3%; font-size:1.2em; text-transform: uppercase;}
      .example3 td.example3__day { background: #000; color:#ff0; text-align: center; font-size: 2em;}
      .example3 td.example3__today { background:#f00; color: #fff;  }
    </style>
    <?php
    // set different locale
    setlocale(LC_TIME, 'NL_nl');
    // instantiate calendar with options
    $cal = new JF\UI\SimplePHPCalendar([
      "link"              => FALSE, // default
      "class_name"        => 'example3',
      "style_today"       => TRUE,
      "style_selected"    => FALSE,
      "show_navigation"   => FALSE,
    ]);

    // Draw the calendar
    $cal->draw();
    ?>

  </body>
</html>
