$(document).ready(function(){

	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="sectionid" id="section_id"></td>' + 
			'<td>' +
            '<a class="add add_transac" title="Add" name="add_transac" id="add_transac" data-toggle="tooltip"><i class="material-icons"></i></a>'+
            '<a class="delete" " title="Delete" data-toggle="tooltip" name="cancel_add_transac" id="cancel_add_transac"><i class="material-icons"></i></a>'+
                '</td>' +
        '</tr>';
    	$("table").append(row);		
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        // $('[data-toggle="tooltip"]').tooltip();
    });
    
    $(document).on('click','#cancel_add_transac',function(e)
	{
		var text = $('#section_id').val();
		var officeid = $('.officeidid').val();
				$.ajax({
						url:"transaction_reload.php",
						method:"POST",
						data:{officeid: officeid},
				success: function(data){
                    document.getElementById("button-search").disabled = false;
				  $("#transtable").find("tbody").children().remove()
				  $("#transtable").append(data);
				}
					});
	});
    
    $(document).on('click','#add_transac',function(e)
	{
		var text = $('#section_id').val();
		var officeid = $('.officeidid').val();
		$.ajax({
			url:'transaction_add.php',
			data:{text:text,officeid:officeid},
			method:'post',
			success: function(data)
			{
				alert('Success');

				$.ajax({
						url:"transaction_reload.php",
						method:"POST",
						data:{officeid: officeid},
				success: function(data){
                    
                    document.getElementById("button-search").disabled = false;
				  $("#transtable").find("tbody").children().remove()
				  $("#transtable").append(data);
				}
					});
			}
		});
	});
//<input type="submit" class="form-control" value="ADD" name="add_transac" id="add_transac">
	//  $(document).on('click','.edit_transac',function(e)
	// {
		
	// });


 //    	$('[data-toggle="tooltip"]').tooltip();
	// var actions = $("table td:last-child").html();
	// var text1;
	// var text2;
	// var xhr = new XMLHttpRequest();
	// Add row on add button click
	$(document).on("click", ".add2", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
		$(this).parents("tr").find(".error").first().focus();

		var text = $('#textinput').val();
		var transac_id = $(this).attr('id');
		
		$.ajax({
			url:'transaction_edit.php',
			data:{text:text,transac_id:transac_id},
			method:'post',
			success: function(data)
			{
				alert('Success');
				$.ajax({
						url:"transaction_load.php",
						method:"POST",
						data:{transac_id:$transac_id},
				success: function(data){

				  $("#transtable").find("tbody").children().remove()
				  $("#transtable").append(data);
				}
					});
			}
		});

		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
				text1 = $(this).val();



			});	
			document.location.href="/pupwebdev/auth/admin/php/AddEditTransaction.php?name=" + text2 + "&text=" + text1;			
			$(this).parents("tr").find(".add2, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}		
    });


	// Edit row on edit button click
	$(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" id="textinput" class="form-control" value="'+$(this).text()+'">');
			text2 = $('#textinput').val();
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	// $(document).on("click", ".delete", function(){
    //     $(this).parents("tr").remove();
	// 	$(".add-new").removeAttr("disabled");
    // });
});