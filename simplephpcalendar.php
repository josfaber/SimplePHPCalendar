<?php
namespace JF\UI;

/**
 * SimplePHPCalendar
 * (C) 2018 J. Faber
 *
 * Version: 1.0
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
    "class_name"        => 'spc__table',
    "style_today"       => TRUE,
    "style_selected"    => TRUE,
    "show_navigation"   => TRUE,
    "nav_left"          => '<',
    "nav_right"         => '>',
  ];

  /**
   * @TODO supply labels
   */

  private $running_day;
  private $days_in_month;
  private $month_name;
  private $month_pad;
  private $selected_date;
  private $calDB = [];

  public function __construct($options = [], $cal_date = null) {
    $this->options = array_replace_recursive($this->defaults, $options);
    if (is_null($cal_date)) {
      $cal_date = isset($_GET[$this->options["date_param"]]) ? $_GET[$this->options["date_param"]] : date('Y-m-d');
    }
    $time = strtotime($cal_date);
    $this->year = date('Y', $time);
    $this->month = date('m', $time);
    $this->day = date('d', $time);
    $this->prev_month = $this->month>1?$this->month-1:12;
    $this->prev_year = $this->month>1?$this->year:$this->year-1;
    $this->next_month = $this->month<12?$this->month+1:1;
    $this->next_year = $this->month<12?$this->year:$this->year+1;
    $this->running_day = date('w', mktime(0,0,0,$this->month,1,$this->year));
  	$this->days_in_month = date('t', mktime(0,0,0,$this->month,1,$this->year));
  	$this->month_pad = str_pad($this->month, 2, "0", STR_PAD_LEFT);
    $this->today = date("Y-m-d");
    $this->selected_date = isset($_GET[$this->options["date_param"]]) ? $_GET[$this->options["date_param"]] : null;
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
    <div class="<?php echo $this->options["class_name"] ?>__container">
    	<table class="<?php echo $this->options["class_name"]; ?>">
    		<thead>
    			<tr>
    				<th class="<?php echo $this->options["class_name"] ?>__title" colspan="7">
  						<?php echo $this->month_name; ?>
    					<span class="year"><?php echo $this->year; ?></span>
    				</th>
    			</tr>
    			<tr>
    				<th class="<?php echo $this->options["class_name"] ?>__day"><?php echo implode("</th><th class=\"{$this->options["class_name"]}__day\">", $this->labels); ?></th>
    			</tr>
    		</thead>
    		<tbody>
    		<tr>
    			<?php
    			for($x = 0; $x < $this->running_day; $x++):
    				echo "<td class=\"{$this->options["class_name"]}__empty\">&nbsp;</td>";
    			 	$this->weekdays++;
    			endfor;
    			for($list_day = 1; $list_day <= $this->days_in_month; $list_day++):
    				$list_day_pad = str_pad($list_day, 2, "0", STR_PAD_LEFT);
    				$isToday = $this->options["style_today"] ? $this->today === date("Y-m-d", mktime(0,0,0,$this->month,$list_day,$this->year)) : FALSE;
    				$isSelected = $this->options["style_selected"] ? $this->selected_date === date("Y-m-d", mktime(0,0,0,$this->month,$list_day,$this->year)) : FALSE;
            $classes = ["{$this->options["class_name"]}__day"];
            !$isToday || array_push($classes, "{$this->options["class_name"]}__today");
            !$isSelected || array_push($classes, "{$this->options["class_name"]}__selected");
            ?>
    				<td class="<?php echo implode(" ", $classes); ?>">
  						<?php if($this->options["link"]!==FALSE): ?><a href="<?php echo "{$this->options["link"]}?{$this->options["date_param"]}={$this->year}-{$this->month_pad}-{$list_day_pad}"?>"><?php endif; ?>
                <?php echo $list_day?>
              <?php if($this->options["link"]!==FALSE): ?></a><?php endif; ?>
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
    					echo "<td class=\"{$this->options["class_name"]}__empty\"> </td>";
    				endfor;
    			endif;
    			?>
    		</tr>
    		</tbody>
    	</table>
      <?php if($this->options["show_navigation"]):?>
        <a href="<?php echo "{$this->options["link"]}?{$this->options["date_param"]}={$this->prev_year}-{$this->prev_month}"?>" class="<?php echo $this->options["class_name"]; ?>__ctrl <?php echo $this->options["class_name"]; ?>__ctrl-l"><?php echo $this->options["nav_left"]?></a>
        <a href="<?php echo "{$this->options["link"]}?{$this->options["date_param"]}={$this->next_year}-{$this->next_month}"?>" class="<?php echo $this->options["class_name"]; ?>__ctrl <?php echo $this->options["class_name"]; ?>__ctrl-r"><?php echo $this->options["nav_right"]?></a>
      <?php endif;?>
    </div>
    <?php
  }
}
