		<div class="input-group">
			<input type="text" id="amount" name="amount" class="form-control" style="max-width:150px;" placeholder="{TEXT_AMOUNT}">
			<input type="text" id="address" name="address" class="form-control" placeholder="{TEXT_ADDRESS}">
			<div class="input-group-append" id="sendButton">
				<button class="btn btn-md btn-primary btn-block" type="button" onClick="javascript:send();">{TEXT_SEND}</button>
			</div>
			<div id="empty" name="empty"></div>
		</div>
       	<script>
			function send()
			{
				var amount = $("#amount").val();
				var address = $("#address").val();
				var sendButtonContent = $("#sendButton").html();
				$("#sendButton").html('<button class="btn btn-md btn-primary btn-block" type="button"><i class="fas fa-spinner fa-spin" style="font-size:1em; color:#FFF;"></i></button>');
				$.ajax({
					url: "{AJAX_URL}send.php?lang={LANG}&amount="+escape(amount)+"&address="+escape(address)
				}).done(function(data) {
					$("#sendButton").html(sendButtonContent);
					$("#empty").html(data);
				});
			}
			$('#amount').keypress(function(event) {
			  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			    event.preventDefault();
			  }
			});
       	</script>