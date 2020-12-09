<?php
	function getLanguagesData(){
		$data = [];

		foreach(new DirectoryIterator('languages') as $dirinfo) {
			if(!$dirinfo->isDot()){

				$dirNameInfo = explode(';', $dirinfo->getFilename());
				$dirData = ['release' => $dirNameInfo[1], 'version' => intval($dirNameInfo[2]), 'name' => $dirNameInfo[3], 'files' => []];

				foreach(new DirectoryIterator('languages/' . $dirinfo->getFilename()) as $fileinfo) {
					if(!$fileinfo->isDot()){
						$dirData['files'][$fileinfo->getFilename()] = 'https://pdf4teachers.org/api/startupdate/languages/' . rawurlencode($dirinfo->getFilename()) . '/' . rawurlencode($fileinfo->getFilename());
					}
				}

				$data[$dirNameInfo[0]] = $dirData;
			}
		}
		return $data;
	}

	$languagesdata = getLanguagesData();

	if(isset($_GET['id']) && isset($_GET['time']) && isset($_GET['starts']) && isset($_GET['version'])){
		
		$id = $_GET['id'];
		$time = intval($_GET['time'])/60;
		$starts = intval($_GET['starts']);
		$version = $_GET['version'];
		$date = date("m.d.y");

		include 'database.php';
		global $db;
		try{
			$q = $db->query("REPLACE INTO stats SET id='$id', time=$time, starts=$starts, version='$version'");
		}catch(Exception $e){
			echo json_encode([$e]);;
		}
		
	}
	header('Content-Type: application/json');
	echo json_encode($languagesdata);
	
	