<?php
function smarty_insert_populate_paginate($params,&$smarty){
	$result = $params['result'];
	$pageurl = $params['pageurl'];
	
	if($result['total']<1){
		return "<div class='pagescontainer'>"._('No record.')."</div>";
	}
	
	$html = "<div class='pagescontainer'>"._('This is page').' '.$result['current']."/".$result['totalpages'].". <a href='$pageurl'>"._('First Page')."</a>";
	if(isset($result['pre'])){
		$preurl =  strripos($pageurl,'?') ? $pageurl."&page=".$result['pre'] : $pageurl."?page=".$result['pre'];
		$html = $html." <a href='$preurl'>"._('Previous Page')."</a>";
	}
	if(isset($result['next'])){
		$nexturl = strripos($pageurl,'?') ? $pageurl."&page=".$result['next']: $pageurl."?page=".$result['next'];
		$html = $html." <a href='$nexturl'>"._('Next Page')."</a>";
	}
	
	if(strripos($pageurl,'?')){
		$html = $html." <a href='".$pageurl."&page=".$result['totalpages']."'>"._('Last Page')."</a>  ";
	}else{
		$html = $html." <a href='".$pageurl."?page=".$result['totalpages']."'>"._('Last Page')."</a>  ";
	}
		
	
	$select = "<select onchange='go2url(this);'>";
	for($i=1;$i<=$result['totalpages'];$i++){
		if($i==$result['current']){
			$select = $select."<option selected='selected'>$i</option>";
		}else{
			$select = $select."<option>$i</option>";
		}
	}
	$select = $select.'</select>';
	
	$page_prefix = strripos($pageurl,'?') ? $pageurl.'&page=' : $pageurl.'?page=' ;
	
	$js = "<script language='JavaScript' type='text/javascript'>
					function go2url(obj){
						window.location = '$page_prefix'+$(obj).val();
					}
				</script>";
	$html = $html.$select.'</div>'.$js;
	return $html;
}
?>