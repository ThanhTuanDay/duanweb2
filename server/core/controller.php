<?php

class Controller
{

	protected function view($view, $data = [])
	{
		$viewPath = __DIR__ . "/../views/" . $view . ".php";
		if (file_exists($viewPath)) {

			require $viewPath;
		} else {
			require "../server/views/404.php";
		}
	}

	protected function loadModel($model)
	{
		if (file_exists("../server/models/" . $model . ".php")) {
			include "../server/models/" . $model . ".php";
			return $model = new $model();
		}

		return false;
	}


}