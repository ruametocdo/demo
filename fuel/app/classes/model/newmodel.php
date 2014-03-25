<?php
class Model_Newmodel extends Fuel\Core\Model_Crud{
    public static function total_record()
	{
		$result = \Fuel\Core\DB::select('*')->from('comments')->execute();
		return count($result);
	}
}