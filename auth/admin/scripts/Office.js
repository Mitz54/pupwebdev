$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
		var roomOptionObj = $("#room-id-options");
		var roomOptions = new Array();
		$("#room-id-options").find("option").each(function(){
			roomOptions.push($(this).val());
		});
				var row = '<tr>' +
				'<td class ="hidden officeID"><input type="hidden" class ="hidden new-value" name="officename" id="officename"></td>' +
            '<td class ="officeName"><input type="text" class="form-control new-value" name="officename" id="officename"></td>' +
            '<td class ="officeCode"><input type="text" class="form-control new-value" name="officecode" id="officecode"></td><td class="officeRoom"><select class="form-control new-value">' +
            '<option value='+ roomOptions[1]+' selected>'+ roomOptions[1] +'</option>';
            for(var i = 2;i<roomOptions.length;i++){
            	row = row + '<option value='+ roomOptions[i]+'>'+ roomOptions[i]+'</option>';
            }
        row = row + '</select></td>' +
			'<td>' + actions + '</td>' +
        '</tr>';
    	$("table").append(row);		
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
	// Add row on add button click
	$(document).on("click", ".add", function(){

		var empty = false;
		var input = $(this).parents("tr").find('input');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();

		var $officeid = $(this).parents("tr")       		//Find parent row <tr>
		.find('.officeID').find('.new-value').val();   		//Get a child with class="SectionID new-value"
		var $officename = $(this).parents("tr")       		//Find parent row <tr>
		.find('.officeName').find('.new-value').val();   		//Get a child with class="SectionID new-value"
		var $officecode = $(this).parents("tr")       		//Find parent row <tr>
		.find('.officeCode').find('.new-value').val();   		//Get a child with class="SectionID new-value"
		var $officeroom = $(this).parents("tr")       		//Find parent row <tr>
		.find('.officeRoom').find('.new-value').val();   		//Get a child with class="SectionID new-value"

		if(!empty){	//update
			// alert('inside not empty');
			$.ajax({
		
				type:"POST",
				url: "php/updateOffice.php",
				data: "&officename=" + $officename
				+ "&officeID=" + $officeid
				+ "&officeroom=" + $officeroom + "&officecode=" + $officecode ,
				success: function(data){
					data = data.trim();
					if(data == 'success' || data == 'updated'){
						alert("Successfully Inserted");
						changeRow($thisobj, true);
					}else if(data == 'exist'){
						alert("Section already exists");

						// remove row
						$thisobj.parents("tr").remove();
						$(".add-new").removeAttr("disabled");
					}else if(data == 'invalid'){
						alert("Course invalid");

						// remove row
						$thisobj.parents("tr").remove();
						$(".add-new").removeAttr("disabled");
					}else if(data == 'year invalid'){
						alert("Invalid Year");

						// remove row
						$thisobj.parents("tr").remove();
						$(".add-new").removeAttr("disabled");
					}
					else
					{
						// alert(data);
					}
				}
			}); // POST addSection end
		}
		else // add
		{
			// alert('inside empty');
		
			$.ajax({
			
				type:"POST",
				url: "php/addOffice.php",
				data: "&officename=" + $officename
				+ "&officeroom=" + $officeroom + "&officecode=" + $officecode ,
				success: function(data){
					data = data.trim();
					if(data == 'success' || data == 'updated'){
						alert("Successfully Inserted");
						changeRow($thisobj, true);
					}else if(data == 'exist'){
						alert("Section already exists");

						// remove row
						$thisobj.parents("tr").remove();
						$(".add-new").removeAttr("disabled");
					}else if(data == 'invalid'){
						alert("Course invalid");

						// remove row
						$thisobj.parents("tr").remove();
						$(".add-new").removeAttr("disabled");
					}else if(data == 'year invalid'){
						alert("Invalid Year");

						// remove row
						$thisobj.parents("tr").remove();
						$(".add-new").removeAttr("disabled");
					}
					else
					{
						// alert(data);
					}
				}
			}); // POST addSection end
		}
			
		//changed back to uneditable
		$(this).parents("tr").find(".error").first().focus();
		$(this).parents("tr").find("td:nth-child(4)").find("select").each(function(){
			$(this).prop("disabled", true);
		});
		$(this).parents("tr").first().focus();
		input.each(function(){
			$(this).parent("td").html($(this).val());
		});	
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").prop("disabled", false);

	});
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
		

		//all column except code		
        $(this).parents("tr").find("td:not(:last-child):not(:nth-child(4))").each(function(){
			$(this).html('<input type="text" class="form-control new-value" value="' + $(this).text() + '">');
		});		
		//code column
		$(this).parents("tr").find("td:nth-child(4)").find("select").each(function(){
			$(this).prop("disabled", false);
		});	
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
		var $officeID = $(this).parents("tr").find('.officeID').text();   	//Get a child with class="RoomID old-value"
		var $thisobj = $(this);
		// alert($officeID);
		if(confirm('Do you really wish to delete this Office?')){
			// post deleteroom
			$.ajax({
				type: "POST",
				url: "php/deleteOffice.php",
				data: "officeID=" + $officeID,
				success: function(data) {
					data = data.trim();
					if(data){
						alert(data);
					}
					else{
						$thisobj.parents("tr").remove();
						$(".add-new").removeAttr("disabled");
					}
				}
			}); 
		} 
    });
});