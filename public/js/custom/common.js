function switch_language(obj){
	var lang = $(obj).val();
	$.getJSON('switch_lang.php',{ 'lang' : lang ,'t' : Date.parse(new Date()) },function(r){
		if(r.flag==0){
    	  location.reload(true);
		}        			  
	});
}


function add2cart(id){
	$.getJSON('cart_action.php',
			{'action' : 'ADD','id' : decodeURIComponent(id), 'type' : 'json'},
			function(r){
				if(r.flag!=0){
					alert('Error');
				}else{
					alert('OK');
				}
			});
}