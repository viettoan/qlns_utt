<?php

	function image_handle($image, $name, $id, $type)
	{
		$date = date("Y_m_d");
		//create file forder
		$target_dir="../../images/images_canbo/".$name."_".$id."/".$type."/";
		$file_name=basename($_FILES['media_link']['name'])."_".$date;
		//create new link file
		$target_file=$target_dir.$file_name;
		//check file size <=> 20MB=20971520 byte
		if($image['size']>20971520){
			$errors[]="over_size";
		}else if($image['size']==NULL){
			$errors[]="does_not_exist_file";
		}
		//check type file
		$file_type=pathinfo($image['name'],PATHINFO_EXTENSION);
		$file_type_allow = array('jpg','png','jpeg','gif');
		if(!in_array(strtolower($file_type), $file_type_allow)){
			$errors[]='type';
		}
		//check file exist in database
		if(file_exists($target_file)){
			$errors[]="exist_in_ds";
		}
		
		return $target_file;
	}