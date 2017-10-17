<?php 

class Plugin_dt_picker {

	public function __construct() {
	
		html::attach('dt_picker',function($name,$value,$extra=[]) {
			ci()->page
				->js(['//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js','//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js'])
				->css('//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css');
		
			$extra['format'] = ($extra['format']) ? $extra['format'] : 'MM/DD/YYYY h:mm A';
			$extra['icon'] = ($extra['icon']) ? $extra['icon'] : 'calendar';
		
			$time = strtotime($value);
			
			$value = ($time < 100) ? '' : date('m/d/YYYY H:i:s',$time);
		
			$j = "{
					icons: {
						time: 'fa fa-clock-o',
						date: 'fa fa-calendar',
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down',
						previous: 'fa fa-chevron-left',
						next: 'fa fa-chevron-right',
						today: 'fa fa-check',
						clear: 'fa fa-trash'
					},
					format: '".$extra['format']."',
					showTodayButton: true,
					showClear: true
				}";
			$j = str_replace([chr(9),chr(10)],'',$j);
		
			ci()->page->domready("$('#data-time-".$name."').datetimepicker(".$j.");");
		
			return '<div class="input-group date" id="data-time-'.$name.'"><input type="text" name="'.$name.'" class="form-control '.$extra['class'].'" value="'.$value.'"><span class="input-group-addon" id="data-time-'.$name.'"><span class="fa fa-'.$extra['icon'].'"></span></span></div>';
		});
	}

} /* end class */
