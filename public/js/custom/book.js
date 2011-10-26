$(document).ready(function(){
    $('#fileupload').fileupload({
        dataType: 'json',
        url: 'ajax_upload.php',
        done: function (e, data) {
            $.each(data.result, function (index, file) {               
                var html = '<tr class="fs" fid="'+file.id+'"><td>'+file.file_name+'</td><td>'+file.file_size+'</td><td><a href="#" onclick="deleteAttachment('+file.id+')">Delete</a></td></tr>' ;
                $(html).appendTo('#files_list');
	                getIDs();
	        });
        }
    });
});
       
function getIDs(){
    var ids = Array();
    $(".fs").each(function(){
        ids.push($(this).attr('fid'));
	});
    $("#file_ids").val(ids.join("|"));
}


function deleteAttachment(id){
	$.getJSON('ajax_delete.php',{'id' : id, 't' : Date.parse(new Date())},function(r){
		if(r.flag == 0){
			$(".fs[fid='"+id+"']").remove();
			getIDs();
		}
	})
	
}