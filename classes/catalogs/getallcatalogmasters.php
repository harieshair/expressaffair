	<?php
		$sql ="SELECT count(id) FROM catalog_master ";
		$whrqury=' where name is not null ';
		if($searchobj!=null){
			$whrqury.=!empty($searchobj->catalogmasterid)?" and catalog_master_id=$searchobj->catalogmasterid ":'';
			$whrqury.=!empty($searchobj->catalogmastername)?" and catalog_master_name like '%$searchobj->catalogmastername%' ":'';
			$whrqury.=!empty($searchobj->description)?" and catalog_master_description like '%$searchobj->description%' ":'';
			$whrqury.=!empty($searchobj->code)?" and catalog_master_code like '%$searchobj->code%' ":'';
		}
		$sql.=$whrqury;
		$totcount = $this->internalDB->queryFirstField($sql);
		if($totcount>0)
		{
			$pages=ceil($totcount/$rows);
			$page = $page == "" ? 0 : $page;
			$start=$page * $rows;
			$searchqury="SELECT id,name,description from  catalog_master ".$whrqury;
			$catalogList = $this->internalDB->query("$searchqury ORDER BY id ASC LIMIT $start, $rows");
		}
		return !empty($catalogList)?$catalogList:null;
		?>
		