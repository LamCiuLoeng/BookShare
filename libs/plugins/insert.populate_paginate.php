<?php
function smarty_insert_populate_paginate($params,&$smarty){
	$result = $params['result'];
	$pageurl = $params['pageurl'];
	
	if($result['total']<1){
		return "<div class='pagescontainer'>No record.</div>";
	}
	
	$html = "<div class='pagescontainer'>This is page ".$result['current']."/".$result['totalpages'].". <a href='$pageurl'>First</a>";
	if(isset($result['pre'])){
		$preurl = $pageurl."&page=".$result['pre'];
		$html = $html." <a href='$preurl'>Previous</a>";
	}
	if(isset($result['next'])){
		$nexturl = $pageurl."&page=".$result['next'];
		$html = $html." <a href='$nexturl'>Next</a>";
	}
	
	$html = $html." <a href='".$pageurl."&page=".$result['totalpages']."'>Last</a>  ";
	$select = "<select onchange='go2url(this);'>";
	for($i=1;$i<=$result['totalpages'];$i++){
		if($i==$result['current']){
			$select = $select."<option selected='selected'>$i</option>";
		}else{
			$select = $select."<option>$i</option>";
		}
	}
	$select = $select.'</select>';
	$js = "<script language='JavaScript' type='text/javascript'>
					function go2url(obj){
						window.location = '$pageurl&page='+$(obj).val();
					}
				</script>";
	$html = $html.$select.'</div>'.$js;
	return $html;
}
?>