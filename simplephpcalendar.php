<?php
namespace JF;

/**
 * @TODO
 *
 * monthname date format
 *
 */
class SimplePHPCalendar {

  public $year;
  public $month;

  private $options;
  private $defaults = [
    "link"              => '',
    "monthname_format"  => '%B',
    "daylabel_format"   => '%a',
    "date_param"        => 'd',
    "class_names"       => "",
    "style_today"       => TRUE,
  ];

  private $running_day;
  private $days_in_month;
  private $month_name;
  private $month_pad;
  private $selected_date;
  private $calDB = [];

  public function __construct($options = [], $the_date = null, $selected_date = null) {
    $this->options = array_replace_recursive($this->defaults, $options);
    if (is_null($the_date)) {
      $the_date = isset($_GET[$this->options["date_param"]]) ? $_GET[$this->options["date_param"]] : date('Y-m-d');
    }
    $time = strtotime($the_date);
    $this->year = date('Y', $time);
    $this->month = date('m', $time);
    $this->day = date('d', $time);
    $this->running_day = date('w', mktime(0,0,0,$this->month,1,$this->year));
  	$this->days_in_month = date('t', mktime(0,0,0,$this->month,1,$this->year));
  	$this->month_pad = str_pad($this->month, 2, "0", STR_PAD_LEFT);
    $this->today = date("Y-m-d");
    $this->selected_date = !is_null($selected_date) && $this->valiDate($selected_date) ? $selected_date : ($this->valiDate($the_date) ? date("Y-m-d", $time) : null);
    $this->labels = [];
  }

  public function valiDate($date) {
    return preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date);
  }

  public function draw() {
    $this->weekdays = 1;
    $this->day_counter = 0;
    $this->month_name = strftime($this->options["monthname_format"], mktime(0,0,0,$this->month,1,$this->year));
    for ($n=1; $n<8; $n++) { array_push($this->labels, strftime($this->options["daylabel_format"], mktime(0,0,0,4,$n,2018))); }

  	for($d=1;$d<=$this->days_in_month;$d++)
  	{
  		$this->calDB[$d] = array();
  		$this->day_start =  mktime(0,0,0,$this->month,$d,$this->year);
  		$this->day_end =  mktime(23,59,59,$this->month,$d,$this->year);
  	}
  	?>
  	<table class="spc__table<?php echo " {$this->options["class_names"]} "; ?>">
  		<thead>
  			<tr>
  				<th class="spc__table__title" colspan="7">
						<?php echo $this->month_name; ?>
  					<span class="year"><?php echo $this->year; ?></span>
  				</th>
  			</tr>
  			<tr>
  				<th class="spc__table__day"><?php echo implode("</th><th class=\"spc__table__day\">", $this->labels); ?></th>
  			</tr>
  		</thead>
  		<tbody>
  		<tr>
  			<?php
  			for($x = 0; $x < $this->running_day; $x++):
  				echo "<td class=\"spc__table__empty\">&nbsp;</td>";
  			 	$this->weekdays++;
  			endfor;
  			for($list_day = 1; $list_day <= $this->days_in_month; $list_day++):
  				$list_day_pad = str_pad($list_day, 2, "0", STR_PAD_LEFT);
  				$isToday = $this->options["style_today"] ? $this->today === date("Y-m-d", mktime(0,0,0,$this->month,$list_day,$this->year)) : FALSE;
  				$isSelected = $this->selected_date === date("Y-m-d", mktime(0,0,0,$this->month,$list_day,$this->year));
          $classes = ["spc__table__day"];
          !$isToday || array_push($classes, "spc__table__today");
          !$isSelected || array_push($classes, "spc__table__selected");
          ?>
  				<td class="<?php echo implode(" ", $classes); ?>">
  					<div class="spc__table__day">
  						<?php if($this->options["link"]): ?><a href="<?php echo "{$this->options["link"]}?{$this->options["date_param"]}={$this->year}-{$this->month_pad}-{$list_day_pad}"?>"><?php endif; ?>
                <?php echo $list_day?>
              <?php if($this->options["link"]): ?></a><?php endif; ?>
  					</div>
  				</td>
  				<?php
  				if($this->running_day == 6):
  					echo "</tr>";
  					if(($this->day_counter+1) != $this->days_in_month):
  						echo "<tr>";
  					endif;
  					$this->running_day = -1;
  					$this->weekdays = 0;
  				endif;
  				$this->weekdays++;
  				$this->running_day++;
  				$this->day_counter++;
  			endfor;
  			if($this->weekdays > 1 && $this->weekdays < 8):
  				for($x = 1; $x <= (8 - $this->weekdays); $x++):
  					echo "<td class=\"spc__table__empty\"> </td>";
  				endfor;
  			endif;
  			?>
  		</tr>
  		</tbody>
  	</table>
    <?php
  }
}
