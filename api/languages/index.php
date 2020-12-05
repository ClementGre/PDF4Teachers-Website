<?php
	
	$data = [];

	foreach(new DirectoryIterator('data') as $dirinfo) {
		if(!$dirinfo->isDot()){

			$dirNameInfo = explode(';', $dirinfo->getFilename());
			$dirData = ['release' => $dirNameInfo[1], 'version' => intval($dirNameInfo[2]), 'files' => []];

			foreach(new DirectoryIterator('data/' . $dirinfo->getFilename()) as $fileinfo) {
				if(!$fileinfo->isDot()){
					$dirData['files'][$fileinfo->getFilename()] = 'https://pdf4teachers.org/api/languages/data/' . rawurlencode($dirinfo->getFilename()) . '/' . rawurlencode($fileinfo->getFilename());
				}
			}

			$data[$dirNameInfo[0]] = $dirData;
		}
	}
	header('Content-Type: application/json');
	echo json_encode($data);