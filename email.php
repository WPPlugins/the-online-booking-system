<?php
function email_callback(){
wpobs_restrict_to_admin();
global $wpdb;
 
if(isset($_REQUEST['signature']))
{
	$signature = esc_html($_REQUEST['signature']);
	 $wpdb->query
            (
                  $wpdb->prepare
                   (
                        "UPDATE ".$wpdb->prefix."sm_email_signature SET initial = %s",
                        $signature
                   )
             );
	
}
else
{
?>
<script type="text/javascript">
  jQuery(function() 
  {
		jQuery("textarea").cleditor({width:"100%", height:"100%"}).focus()
  });
	function getSign()
	{
		var signature=document.getElementById("email_Signature").value;
		jQuery(document).ready(function($) 
		{
			jQuery.ajax
			({
				type: "POST",
				data: "signature="+signature,
				url: '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=email",
				success: function(data) 
				{
					jQuery('#emailsign').css('display','block');
					setTimeout(function() 
					{
						jQuery('#emailsign').css('display','none');	
					}, 1000);
				}
			});
		});
	}
</script>
<div id="divemail">

	<div  class="contentarea">
		<div class="one_wrap fl_left">
			<div class="msgbar msg_Success hide_onC" id="emailsign" style="display: none;margin-top:15px;margin-bottom:-10px;width:98%;margin-left:5px;">
				<span class="iconsweet">=</span>
				<p>
					Emails Signature have been saved successfully.
				</p>
			</div>
			<div class="widget-wp-obs">
				<div class="widget-wp-obs_title">
					<span class="iconsweet">(</span>
					<h5> Email Templates</h5>
				</div>
				<div class="widget-wp-obs_body">
					<ul class="form_fields_container">
						<li>
							<label> <span class="data_actions iconsweet"><a class="tip_east colorbox" id="booktim" href="#bookingtimetemplate" onclick="return text1(this);"  style="text-decoration:none;  color:#818386;">C</a></span><label style="margin-left:5px;cursor:default;">Pending Confirmation Template [Sent to Client]</label></label>
						</li>
						<li>
							<label> <span class="data_actions iconsweet"><a  class="tip_north colorbox" id="confirmtime" href="#bookingtimetemplate" onclick="return text1(this);" style="text-decoration:none; color:#818386;">C</a></span><label style="margin-left:5px;cursor:default;">Confirmation of Booking template [Sent to Client]</label></label>
						</li>
						<li>
							<label> <span class="data_actions iconsweet"><a  class="tip_north colorbox" id="adminbok" href="#bookingtimetemplate" onclick="return text1(this);" style="text-decoration:none; color:#818386;">C</a></span><label style="margin-left:5px;cursor:default;">Admin Approve/Decline email Template [Sent to Admin]</label></label>
						</li>
						<li>
							<label> <span class="data_actions iconsweet"><a  class="tip_north colorbox" id="declinebok" href="#bookingtimetemplate" onclick="return text1(this);" style="text-decoration:none; color:#818386;">C</a></span><label style="margin-left:5px;cursor:default;">Appointment Declined template [Sent to Client]</label></label>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="one_wrap fl_left">
			<div class="widget-wp-obs" style="margin-top:0px">
				<div class="widget-wp-obs_title">
					<span class="iconsweet">}</span>
					<h5> Email Signature </h5>
				</div>
				<div class="widget-wp-obs_body">
					<ul class="form_fields_container">
						<?php
						$signature = $wpdb->get_col
						(
						      $wpdb->prepare
						      (
						           	"SELECT initial FROM ".$wpdb->prefix."sm_email_signature"
						      )
						);
						
						?>
						<li>
							<label>Email Signature :</label>
							<div class="form_input">
								<textarea id="email_Signature" name="email_Signature" rows="15" cols="100"  class="tinymce" style="width:800px !important;"><?php echo $signature[0];?></textarea>
							</div>
						</li>
						<li>
							<a class="greyishBtn button_small" onclick="getSign();"  style="margin-left:240px" >Save Changes</a>
							<input type="hidden" id="inphid"/>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function text1(e)
		{
			<?php
			$table_name = $wpdb -> prefix . "sm_emails";
			?>
			var whrcls="";
			switch(e.id)
			{
					case "booktim":
										jQuery("#lblid").html("Template for Clients at the time of Booking.");
										whrcls="single_client";
									
					break;
					case "confirmtime":
										
										jQuery("#lblid").html("Template for Clients at the time of Confirmation.");
										whrcls="single_client_confirm";
					break;
					case "adminbok":
										
										jQuery("#lblid").html("Template for Admin at the time of Booking.");
										whrcls="admin";
					break;
					case "declinebok":
										
										jQuery("#lblid").html("Template for Admin at the time of Decline.");
										whrcls="decline_client";
					break;
			}

			document.getElementById('inphid').value=whrcls;

			jQuery(document).ready(function($) 
			{
				jQuery.ajax
					({
						type: "POST",
						data: "whrclause="+whrcls,
						url: '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=cont",
						success: function(data) 
						{
							jQuery("#idbooktime").html(data);
							jQuery.colorbox.resize();
						}
					});
					jQuery.ajax
					({
							type: "POST",
							data: "method=subject&type="+whrcls,
							url: '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=cont",
							success: function(data) 
							{
								jQuery("#subject1").html(data);
			
							}
					});
			 });
			}
			
			function savetemplates()
			{
				var typc=document.getElementById('inphid').value;
				var typcls = encodeURIComponent(typc);
				var conte=document.getElementById('elm1').value;
				var content = encodeURIComponent(conte);
				var subjt=document.getElementById('emailsubject').value;
				var subjct = encodeURIComponent(subjt);
				jQuery.ajax
				({
					type: "POST",
					data: "updatetemplates="+typcls+"&content="+content+"&subjct="+subjct,
					url: '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=cont",
					success: function(data) 
					{
						jQuery("#booktemmsg").css('display','block');
						jQuery.colorbox.resize();
						setTimeout(function()
						{
							jQuery("#booktemmsg").css('display','none');
							jQuery.colorbox.close();
						},1000);
					}
				});
			
			}
	</script>
	<div style="display:none;">
	<div style="width:920px" id="bookingtimetemplate">
		<div class="msgbar msg_Success hide_onC" id="booktemmsg" style="display: none;margin-top:5px;margin-bottom:5px;width:97%;margin-left:5px;">
			<span class="iconsweet">=</span>
			<p>
				Template has been successfully Saved.
			</p>
		</div>
		<div class="widget-wp-obs" style="margin:5px;">
			<div class="widget-wp-obs_title">
				<span class="iconsweet">7</span>
				<h5><label id="lblid"></label></h5>
			</div>
			<div class="widget-wp-obs_body">
				<ul class="form_fields_container">
					<li>
						<label>Subject :</label>
						<div class="form_input" id="subject1">
							
					
						</div>
					</li>
					<li>
						<label>Content :</label>
						<div class="form_input" id="idbooktime">
						
						</div>
					</li>
					<li>
						<a class="greyishBtn button_small" onclick="return savetemplates();" id="btnsavsubject" style="margin-left:202px" >Save Template</a>
						<input type="hidden" id="inphid"/>
					</li>
				</ul>
			</div>
		</div>
	</div>
	</div>
</div>
<?php
}
}
?>