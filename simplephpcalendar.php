<?php
namespace JF;

class SimplePHPCalendar {

  public $link;
  public $year;
  public $month;

  private $running_day;
  private $days_in_month;
  private $month_name;
  private $month_pad;
  private $calDB = [];

  public function __construct($the_date = null) {
    // var_dump($the_date);
    // var_dump(strtotime($the_date), date('Y-m-d', strtotime($the_date)));
    $time = strtotime($the_date);
    $this->year = date('Y', $time);
    $this->month = date('m', $time);
    $this->day = date('d', $time);
    $this->running_day = date('w', mktime(0,0,0,$this->month,1,$this->year));
  	$this->days_in_month = date('t', mktime(0,0,0,$this->month,1,$this->year));
  	$this->month_name = strftime('%b', mktime(0,0,0,$this->month,1,$this->year));
  	$this->month_pad = str_pad($this->month, 2, "0", STR_PAD_LEFT);
    $this->today = date("Y-m-d");
  }

  public function draw() {
  	$this->weekdays = 1;
  	$this->day_counter = 0;
  	$this->labels = array("Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za");

  	for($d=1;$d<=$this->days_in_month;$d++)
  	{
  		$this->calDB[$d] = array();
  		$this->day_start =  mktime(0,0,0,$this->month,$d,$this->year);
  		$this->day_end =  mktime(23,59,59,$this->month,$d,$this->year);
  	}
  	?>
  	<table class="calendar">
  		<thead>
  			<tr>
  				<th class="title" colspan="7">
						<?php echo $this->month_name; ?>
  					<span class="year"><?php echo $this->year; ?></span>
  				</th>
  			</tr>
  			<tr>
  				<th class="day"><?php echo implode("</th><th class=\"day\">", $this->labels); ?></th>
  			</tr>
  		</thead>
  		<tbody>
  		<tr>
  			<?php
  			for($x = 0; $x < $this->running_day; $x++):
  				echo "<td class=\"empty\">&nbsp;</td>";
  			 	$this->weekdays++;
  			endfor;
  			for($list_day = 1; $list_day <= $this->days_in_month; $list_day++):
  				$list_day_pad = str_pad($list_day, 2, "0", STR_PAD_LEFT);
  				$isToday = $this->today === date("Y-m-d", mktime(0,0,0,$this->month,$list_day,$this->year));
  				$isSelected = $this->day === date("Y-m-d", mktime(0,0,0,$this->month,$list_day,$this->year));
          $classes = [];
          !$isToday || array_push($classes, "today");
          !$isSelected || array_push($classes, "selected");
  				?>
  				<td class="<?php echo implode(" ", $classes); ?>">
  					<div class="day">
  						<?php if($this->link): ?><a href="<?php echo "{$this->link}?d={$this->year}-{$this->month_pad}-{$list_day_pad}"?>"><?php endif; ?>
                <?php echo $list_day?>
              <?php if($this->link): ?></a><?php endif; ?>
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
  					echo "<td class=\"empty\"> </td>";
  				endfor;
  			endif;
  			?>
  		</tr>
  		</tbody>
  	</table>
    <?php
  }
}
