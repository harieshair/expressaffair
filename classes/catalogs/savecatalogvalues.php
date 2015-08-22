<?php
if ($this->oCache->bEnabled)  // if APC enabled
{
	$catalogmasters=array('CountryList','StateList','CityList','YearList','CollegeList','DegreeList','DepartmentList','ComapniesList','PGDegreeList','DesignationList');
	foreach($catalogmasters as $master)
	{
		if($this->oCache->getData($master.'_'.$this->CLIENTID)==null){
			$catalogarray=$this->GetAllCatalogValuesByMasterNames(array($master));
			$this->oCache->setData($master.'_'.$this->CLIENTID, $catalogarray); // saving data to memory
		}
	}

}
?>