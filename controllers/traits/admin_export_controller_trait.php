<?php 

trait admin_export_controller_trait {

	public function exportAction($controller='') {
		$this->load->helper('download');
	
		$filename = $controller.'_'.date('Y_m_d_H_i').'.csv';
		
		$dbc = $this->{$this->controller_model}->index();
		
		$first_row = true;
		
		$fp = fopen('php://temp', 'w+');
		
		foreach ($dbc as $row) {
			$row = (array)$row;

			if ($first_row) {
	    	fputcsv($fp,array_keys($row));
				
				$first_row = false;
			}

	    fputcsv($fp, $row);
		}
		
		/* Set the pointer back to the start */
		rewind($fp);
		
		/* Fetch the contents of our CSV */
		$csv_contents = stream_get_contents($fp);
		
		/* Close our pointer and free up memory and /tmp space */
		fclose($fp);
		
		force_download($filename,$csv_contents,'application/xls');
	}

} /* end class */
