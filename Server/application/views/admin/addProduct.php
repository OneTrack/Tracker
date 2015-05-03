  <link rel="stylesheet" href="/assets/css/fileinput.css">
  <script src="/assets/js/fileinput.js"></script>
  <script type='text/javascript'>
	$(document).ready(function(){
		$("#purchaseDate").datepicker();
	});
	var uniqueNames = [];
	var typeheadData=['Apple','HTC','Samsung','Google'];
	$.each(typeheadData, function(i, el){
	if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
	});
	$('#productList').typeahead({
	source: uniqueNames
	});
	$("#input-files").fileinput({
	    uploadUrl: "/someaction", // server upload action
	    uploadAsync: true,
	    maxFileCount: 5
	});
  </script>
<div class="overviewDetails">
 <h2 class="overviewHeder">Add New Product</h2>
 <br>
 <form>
    <lable class="control-label" for="productList">Product</lable>
    <input type="text" id="productList" class="form-control" data-provide="typeahead" placeholder="Select Product">
	<lable class="control-label" for="sNumber">Serial Number</lable>
	<input type="text" class="form-control" id="sNumber" placeholder="Serial Number">
	<lable class="control-label" for="purchaseDate">Purchase Date</lable>
	<input type="text" class="form-control" style="width:180px;" id="purchaseDate" placeholder="Select Date">
	<lable class="control-label" for="input-files">Upload Documents</lable>
	<input id="input-files" name="input-files[]" type="file" multiple class="file-loading">
	<br>
	<input type="submit" class="btn btn-info" value="Add" />
	
</form>
</div>