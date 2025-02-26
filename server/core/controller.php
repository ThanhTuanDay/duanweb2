<?php 

Class Controller
{

	protected function view($view,$data = [])
	{
		if(file_exists("../server/views/". $view .".php"))
 		{
 			require "../server/views/". $view .".php";
 		}else{
 			require "../server/views/404.php";
 		}
	}

	protected function loadModel($model)
	{
		if(file_exists("../server/models/". $model .".php"))
 		{
 			include "../server/models/". $model .".php";
 			return $model = new $model();
 		}

 		return false;
	}


}