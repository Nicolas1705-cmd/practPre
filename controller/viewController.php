<?php 

require_once "model/viewModel.php";
class viewController extends viewModel{

	public function get_estructura_controller(){
		return require_once "./view/estructura.php";

	}
	public function get_view_controller(){
		if(isset($_GET["views"])){
			$route=explode("/",$_GET['views']);
			$request=viewModel::get_view_model($route[0]);
		}else{
			$request ="login";
		}
		return $request;
	}

}