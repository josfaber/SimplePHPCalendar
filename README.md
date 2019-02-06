
Hi there.

Thanks for using one of my scripts! I hope you will be able to implement it in your applications with ease.
To get you started I've included three example uses which cover most of the use cases. You'll find them in example.php.

### HOW TO USE ###
Simply require the class file and instantiate a calendar, with or without options:

  `require './class.simplephpcalendar.php';`

  `$cal = new JF\UI\SimplePHPCalendar();`

   or
```
  $cal = new JF\UI\SimplePHPCalendar([
    "link"              => 'index.php',
    "monthname_format"  => '%b',
    "daylabel_format"   => '%A',
    "nav_left"          => '<i class="fas fa-angle-left"></i>', // fontawesome!
    "nav_right"         => '<i class="fas fa-angle-right"></i>', // fontawesome!
  ]);
```


### OPTIONS ###
There are some options you can pass to the constructor of the calendar, which I'll explain here:
```
  "link"              => (String) The link to use for the days. The day parameter is added to this link. Default: ''
  "monthname_format"  => (String) The format for the monthname, as specified in http://php.net/manual/en/function.strftime.php. Default: '%B'
  "daylabel_format"   => (String) The format for the day labels, as specified in http://php.net/manual/en/function.strftime.php. Default: '%a'
  "date_param"        => (String) The parameter name to be used. Default: 'd'
  "class_name"        => (String) The classname of the <table> that holds the calendar. Default: 'spc__table'
  "style_today"       => (Boolean) Determines if the date of today should be styled. Default: TRUE
  "style_selected"    => (Boolean) Determines if the selected date (in the parameter) should be styled. Default: TRUE
  "show_navigation"   => (Boolean) Determines if the back and forth navigation should be visible. Default: TRUE
  "nav_left"          => (String) The back and forth navigation string to be used for backwards. Default: '<'
  "nav_right"         => (String) The back and forth navigation string to be used for forwards. Default: '>'
```

### STYLE ###
The calendar items can be styled through CSS. I've explained the CSS a bit in the first example in examples.php.
The element styles are prefixed and reasonable BEM'ish (http://getbem.com/), so you'll have no problem incorporating it inside your existing SCSS.


### OUTPUT ###
A rendered calendar item looks like this:
```
  <div class="{CLASSNAME}__container">
    <table class="{CLASSNAME}">
    	<thead>
    		<tr>
    			<th class="{CLASSNAME}__title" colspan="7">{MONTH NAME}<span class="year">{YEAR}</span>
    			</th>
    		</tr>
    		<tr>
          ...
    			<th class="{CLASSNAME}__day">{DAY LABEL}</th> // 7 cols
          ...
    		</tr>
    	</thead>
    	<tbody>
        ...
    		<tr> // multiple rows
          ...
    			<td>{DAY NUMBER}</td> // 7 cols
          ...
        </tr>
        ...
    	</tbody>
    </table>
    <a href="{LINK}?{PARAM NAME}={PREV MONTH}" class="{CLASSNAME}__ctrl {CLASSNAME}__ctrl-l">{LEFT}</a>
    <a href="{LINK}?{PARAM NAME}={NEXT MONTH}" class="{CLASSNAME}__ctrl {CLASSNAME}__ctrl-r">{RIGHT}</a>
  </div>
```

### Example styles ###
[[https://github.com/josfaber/SimplePHPCalendar/master/examples.jpg|alt=examples]]

### TROUBLESHOOTING ###
If there are problems with the namespacing, you could always copy/paste the class code block from class.simplephpcalendar.php to your own script.

If you encounter problems with the locale/translation and/or timezones, check the languages installed on your webserver and check this document for clues: http://php.net/manual/en/function.strftime.php.
