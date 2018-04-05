        <h2>{TITLE}</h2>
        <div class="row">
        	<div class="col-sm-12 col-md-3 pt-3">
        		<p id="createButton"><button class="btn btn-md btn-primary btn-block" onClick="javascript:createAddress();">{TEXT_CREATE_NEW_ADDRESS}</button></p>
        	</div>
        	<div class="col-sm-12 col-md-6 pt-3">
        		{SEND}
        	</div>        	
        	<div class="col-sm-12 col-md-3 text-right pt-3">
        		<h6><strong>{TEXT_BALANCE} ({TICKER})</strong><br>{BALANCE}</h6>
        	</div>
    	</div>
        <div class="table-responsive pt-3">
	        <table class="table">
			  <thead>
			    <tr>
			      <th scope="col">{TEXT_ADDRESS}</th>
			    </tr>
			  </thead>
			  <tbody id="reloadAddresses">
			  	{ADDRESSES}
			  </tbody>
	       	</table>
       	</div>
       	<script>
       		function reloadAddresses()
       		{
				$("#reloadAddresses").load("{AJAX_URL}get-addresses.php?lang={LANG}", function(data){});
			}
			reloadAddresses();

			function createAddress()
			{
				var content = $("#createButton").html();
				$("#createButton").html('<button class="btn btn-md btn-primary btn-block"><i class="fas fa-spinner fa-spin" style="font-size:1em; color:#FFF;"></i></button>');
				$.ajax({
					url: "{AJAX_URL}create-address.php?lang={LANG}"
				}).done(function(data) {
					$.when(reloadAddresses()).then($("#createButton").html(content));
				});
			}
       	</script>