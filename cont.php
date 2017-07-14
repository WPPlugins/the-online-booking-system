<?php
function cont_callback(){
wpobs_restrict_to_admin();
global $wpdb;
$url = plugins_url('', __FILE__) . "/"; 
if(isset($_REQUEST['whrclause']))
{
?>
 	<script type="text/javascript" src="<?php echo $url;?>src/jquery.cleditor.min.js"></script>
    <link rel="Stylesheet" type="text/css" href="<?php echo $url;?>src/jquery.cleditor.css" />
    	<script type="text/javascript">
	    jQuery(function(){
            jQuery("textarea").cleditor({width:"100%", height:"100%"}).focus()
        });
   		 </script>
<?php 
		// select email content and subject from database and and pass it to textarea
		$table_name = $wpdb -> prefix . "sm_emails";
		$booktm_content = $wpdb -> get_var($wpdb->prepare('SELECT content FROM ' . $table_name . ' WHERE type = %s', esc_attr($_REQUEST['whrclause'])));
		$stored_subject = $wpdb -> get_var($wpdb->prepare('SELECT subject FROM ' . $table_name . ' WHERE type = %s', esc_attr($_REQUEST['whrclause'])));
?>
		<textarea id="elm1" name="elm1" rows="15" cols="23"  class="tinymce" style="width:700px !important;"><?php echo $booktm_content;?></textarea>
<?php
}
else if(isset($_REQUEST['updatetemplates']))
{
$table_name = $wpdb->prefix."sm_emails";
$typee = html_entity_decode($_REQUEST['updatetemplates']);
$content = html_entity_decode($_REQUEST['content']);
$subjct = html_entity_decode($_REQUEST['subjct']);
$qry = $wpdb->prepare("UPDATE ".$table_name." SET content = %s, subject = %s WHERE type = %s", $content, $subjct, $typee);
$wpdb->query($qry);
}
else if($_REQUEST['method'] == "subject")
{
		// select subject of the email template from the database
		$table_name = $wpdb -> prefix . "sm_emails";
		$stored_subject = $wpdb -> get_var($wpdb->prepare('SELECT subject FROM ' . $table_name . ' WHERE type = %s', esc_attr($_REQUEST['type'])));
		?>
		<input type="text" id="emailsubject" value="<?php echo $stored_subject; ?>" style="width:700px !important;" />
		<?php
}
die;
}
?>