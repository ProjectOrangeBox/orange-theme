<?php

/* 001_init.php */

class Migration_001_init extends \Migration_base
{

	/* example up function */
	public function up()
	{
		$hash = $this->get_hash();

		echo $hash.' up'.chr(10);

		return true;
	}

	/* example down function */
	public function down()
	{
		/* don't delete the defaults */
		$hash = $this->get_hash();

		echo $hash.' down'.chr(10);

		return true;
	}
} /* end migration */
