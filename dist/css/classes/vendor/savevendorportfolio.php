<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['portfolioid'])){

		isset($entity['portfoliotype'])?$updateObject['portfoliotype']=$entity['portfoliotype']:'';
		isset($entity['link'])?$updateObject['link']=$entity['link']:'';
		isset($entity['aboutus'])?$updateObject['aboutus']=$entity['aboutus']:'';	
		$this->internalDB->update('portfolios',$updateObject,"id=%i",$entity['portfolioid']);
		return array('Id'=>$entity['portfolioid'] );	
	}
	else{
		isset($entity['portfoliotype'])?$updateObject['portfoliotype']=$entity['portfoliotype']:'';
		isset($entity['link'])?$updateObject['link']=$entity['link']:'';
		isset($entity['aboutus'])?$updateObject['aboutus']=$entity['aboutus']:'';
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('portfolios',$updateObject);
		return array('Id'=>$this->internalDB->insertId() );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>