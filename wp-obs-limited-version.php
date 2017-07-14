<?php
/*
Plugin Name: WP-OBS Limited [The Online Booking System Plugin]
Plugin URI: http://wp-obs.com
Description: The WP-OBS (WordPress Online Booking System) is a Booking Calendar Plugin that will enable WordPress running sites to manage all their business bookings/appointments from one place.
Author: WP-OBS
Version: 2.0.0.51
Author URI: http://wp-obs.com
Copyright 2012 WP-OBS (email : support@wp-obs.com)
*/
function wpobs_restrict_to_admin() {

    if ( ! current_user_can( 'administrator' ) ) {

      echo 'You are not allowed to access the requested page. Please click <a href="'.admin_url().'">here to log in</a>.';

      exit;

    }
}

function enqueue_func() {
	wp_enqueue_style('droplinetabs', plugins_url('/css/droplinetabs.css', __FILE__));
 	wp_enqueue_style('reset', plugins_url('/css/reset.css', __FILE__));
	wp_enqueue_style('intro', plugins_url('/css/intro.css', __FILE__));
    wp_enqueue_style('main', plugins_url('/css/main.css', __FILE__));
    wp_enqueue_style('typography', plugins_url('/css/typography.css', __FILE__));
    wp_enqueue_style('tipsy', plugins_url('/css/tipsy.css', __FILE__));
    wp_enqueue_style('colorbox-css', plugins_url('/source/colorbox.css', __FILE__));
    wp_enqueue_style('highlight', plugins_url('/css/highlight.css', __FILE__));
    wp_enqueue_style( 'jquery.ui.theme', plugins_url( '/css/jquery.ui.css', __FILE__ ) );
    
}
function global_enqueue_func()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-datepicker');
	
	wp_enqueue_script('excanvas', plugins_url('/js/excanvas.js',__FILE__));
	wp_enqueue_script('jquery.tipsy', plugins_url('/js/jquery.tipsy.js',__FILE__));
    wp_enqueue_script('form_elements', plugins_url('/js/form_elements.js',__FILE__));
    wp_enqueue_script('highlight', plugins_url('/js/highlight.js',__FILE__));
	wp_enqueue_script('colorbox', plugins_url('/source/jquery.colorbox.js',__FILE__));
}
add_action('init', 'global_enqueue_func');
add_action('wp_head', 'global_enqueue_func');
add_action('admin_enqueue_scripts', 'enqueue_func');
/****************************************************** Create Database *******************************************/
function sm_create_db() {
	include_once 'installDb.php';
	installDatabase();
}
// sm_create_db
register_activation_hook(__FILE__, 'sm_create_db');

function POD_deactivate() {
    global $wpdb;
    $table_name = $wpdb->prefix . "sm_services";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_services_time";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_clients";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_bookings";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_timings";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_allocate_serv";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_block_date";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));
	
	$table_name = $wpdb->prefix . "sm_block_time";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_employees";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_emails";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_customer_notifications";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_cuntry";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_booking_link_img";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_currency";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));
    $table_name = $wpdb->prefix . "sm_staff_notifications";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_email_signature";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_booking_field";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));

    $table_name = $wpdb->prefix . "sm_settings";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));
	
	$table_name = $wpdb->prefix . "sm_translation";
    $sql = "DROP TABLE " . $table_name;
    $wpdb->query($wpdb->prepare($sql));
}
register_uninstall_hook(__FILE__, 'POD_deactivate');
/*************************************************************************************************************************/
function sm_plugin_menu() 
{
    $icon_path = plugin_dir_url(__FILE__);
    $page = add_menu_page('wp-obs Plugin Manager', 'WP-OBS Plugin', 'manage_options', 'TabBooking', 'sm_tab_booking', $icon_path . 'icon.png');
    add_submenu_page( '', '', '', 'manage_options', 'TabWiz', 'sm_tab_wizard');
	$page = add_submenu_page( '', '', '', 'manage_options', 'TabBooking', 'sm_tab_booking');
	$pageemp = add_submenu_page( '', '', '', 'manage_options', 'TabEmployees', 'sm_tab_employee');
	$pageservice = add_submenu_page( '', '', '', 'manage_options', 'TabServices', 'sm_tab_service');
    $pagecustomer = add_submenu_page( '', '', '', 'manage_options', 'TabCustomers', 'sm_tab_customer');
	add_submenu_page( '', '', '', 'manage_options', 'TabNotifications', 'sm_tab_nofification');
	$pageemail = add_submenu_page( '', '', '', 'manage_options', 'TabEmail', 'sm_tab_email');
	add_submenu_page( '', '', '', 'manage_options', 'TabExports', 'sm_tab_export');
	$pagebookingform = add_submenu_page( '', '', '', 'manage_options', 'TabBookings', 'sm_tab_bookings');
	add_submenu_page( '', '', '', 'manage_options', 'TabBookingsLink', 'sm_tab_bookinglink');
	$pagesetting = add_submenu_page( '', '', '', 'manage_options', 'TabSettings', 'sm_tab_setting');
}
function my_enqueue($hook) {
	switch($hook){
		case 'admin_page_TabBooking':
			registerBookingScripts();
		break;
		case 'admin_page_TabEmployees':
			registerEmployeesScripts();
		break;
		case 'admin_page_TabCustomers':
			registercustomerScripts();
		break;
		case 'admin_page_TabServices':
			registerServicesScripts();
		break;
		case 'admin_page_TabEmail':
			registerEmailScripts();
		break;
		case 'admin_page_TabSettings':
			registersettingScripts();
		break;
		case 'admin_page_TabBookings':
			registerbookformScripts();
		break;
	}
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );
add_action('admin_menu', 'sm_plugin_menu');

function registerBookingScripts()
{
	wp_enqueue_style('dailog', plugins_url('/csscal/dailog.css', __FILE__));
	wp_enqueue_style('calendarcss', plugins_url('/csscal/calendar.css', __FILE__));
	wp_enqueue_style('maincss', plugins_url('/csscal/main.css', __FILE__));
	
	wp_enqueue_script('Common', plugins_url('/src/Common.js',__FILE__));
	wp_enqueue_script('wdCalendar_lang_US', plugins_url('/src/wdCalendar_lang_US.js',__FILE__));
	wp_enqueue_script('calendar', plugins_url('/src/jquery.calendar.js',__FILE__));
	wp_enqueue_script('mainjs', plugins_url('/js/main.js',__FILE__));

}
function registerEmployeesScripts()
{
	wp_enqueue_style('calendar5', plugins_url('/css/calendar5.css', __FILE__));
	wp_enqueue_style('miniColors', plugins_url('/css/jquery.miniColors.css', __FILE__));
	wp_enqueue_style('front', plugins_url('/css/front.css', __FILE__));
	wp_enqueue_style('maincss', plugins_url('/csscal/main.css', __FILE__));
	
	wp_enqueue_script('miniColorsmin', plugins_url('/js/jquery.miniColors.min.js',__FILE__));
	wp_enqueue_script('mainjs', plugins_url('/js/main.js',__FILE__));

}

function registerServicesScripts()
{
	wp_enqueue_script('mainjs', plugins_url('/js/main.js',__FILE__));
}

function registercustomerScripts()
{
	wp_enqueue_script('mainjs', plugins_url('/js/main.js',__FILE__));
}

function registerEmailScripts()
{

	wp_enqueue_style('CLEditorCSS', plugins_url('/src/jquery.cleditor.css', __FILE__));
	wp_enqueue_script('CLEditor', plugins_url('/src/jquery.cleditor.min.js',__FILE__));
}
function registerbookformScripts()
{
	wp_enqueue_script('mainjs', plugins_url('/js/main.js',__FILE__));
}
function registersettingScripts()
{
	wp_enqueue_script('mainjs', plugins_url('/js/main.js',__FILE__));
	wp_enqueue_style('CLEditorCSS', plugins_url('/src/jquery.cleditor.css', __FILE__));
	
	wp_enqueue_script('CLEditor', plugins_url('/src/jquery.cleditor.min.js',__FILE__));
}
	


if(!function_exists('_add_my_quicktags'))
{
    function _add_my_quicktags()
    {
	?>
        <script type="text/javascript">
        /* Add custom Quicktag buttons to the editor WordPress ver. 3.3 and above only
         *
         * Params for this are:
         * - Button HTML ID (required)
         * - Button display, value="" attribute (required)
         * - Opening Tag (required)
         * - Closing Tag (required)
         * - Access key, accesskey="" attribute for the button (optional)
         * - Title, title="" attribute (optional)
         * - Priority/position on bar, 1-9 = first, 11-19 = second, 21-29 = third, etc. (optional)
         */
       if ( typeof QTags != 'undefined' )
	   {
			QTags.addButton( 'Book It Online', 'Book It Online', '[booking link color=orange size=30px padding=5px]BOOK NOW[/booking link]');
       }
        </script>
    <?php 
	}
    // We can attach it to 'admin_print_footer_scripts' (for admin-only) or 'wp_footer' (for front-end only)
    add_action('admin_print_footer_scripts',  '_add_my_quicktags');
}
function booking_func( $atts, $content = null ) {
   extract(shortcode_atts(array(
	"color" => 'blue',
        "size" => '14px',
        "padding" => '0px',
	), $atts));   
  return sm_send_data($service,$color,$padding,$size,$content);
    } // booking_func

	
function booking_func1( $atts, $content = null ) {
   extract(shortcode_atts(array(
	"color" => 'blue',
        "size" => '14px',
        "padding" => '0px',
		"service" => '',
	), $atts));   
  return sm_send_data($service,$color,$padding,$size,$content);
    } // booking_func
add_shortcode( 'booking link', 'booking_func' );
add_shortcode( 'booking', 'booking_func1' );
/************* Send Data ************/
function sm_send_data($service_clicked,$color,$padding,$size,$content) 
{
	?>

	<div class="backdrop"></div>

	<script type="text/javascript">
	var uri = "<?php echo plugins_url('', __FILE__);?>" 

		<?php
		global $wpdb;
		$trans = $wpdb->get_results
		(
				$wpdb->prepare
				(
					"SELECT * FROM ".$wpdb->prefix."sm_translation "
					
				)
		);
		for($i=0;$i<=count($trans);$i++)
		?>
		
		var titles = "<?php echo $trans[18]->translate; ?>";
		

	function frontend2()
	{
					var windowWidth = document.documentElement.clientWidth;
					var clientWidth = (windowWidth / 2) - 410;
				
					if(document.getElementById('hitime'))
					{
						jQuery('hitime').remove();
					}										
					jQuery('.box_bookingLink').remove();
					jQuery('body').append("<div class='box_bookingLink' style='border: 10px solid #525252;left:"+clientWidth+"px;'><div class='close1'>"+titles+"</div><div class='close'>X</div><div id='link210'></div><div id='loading' class='loading'><img src='"+uri+"/images/loading.gif'/></div></div>");
					jQuery('#link210').load('<?php echo admin_url('admin-ajax.php'); ?>' + "?action=front_bookinglink",function(){jQuery('#loading').remove();jQuery('.maincontainer1').css('display', 'block');});
					jQuery('.box_bookingLink').animate({'opacity':'1.00'});
					jQuery('.box_bookingLink').css('display', 'block');
					jQuery('.close').click(function(){
					close_box();
					});
 
					jQuery('.backdrop').click(function(){
					
					close_box();
					});
					function close_box()
					{
						jQuery('.box_bookingLink').remove();
						jQuery('.backdrop, .box_bookingLink').animate({'opacity':'0'}, function(){
						jQuery('.backdrop, .box_bookingLink').css('display', 'none');
				});
			}
	
	}
	</script>	
	<?php 
		if($service_clicked!=0 && $service_clicked!='undefined')
		{
			$data = "<a href='#' onClick='frontend($service_clicked);' style='color:$color; padding: $padding; font-size: $size;'>$content</a>";
			return $data;
		}
		else
		{
			$data = "<a href='#' onClick='frontend2();' style='color:$color; padding:$padding; font-size:$size;'>$content</a>";
			return $data;
		}
} // sm_send_data

function sm_tab_wizard()
{
	require_once 'header.php';
	include_once ("wizard.php");
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabWiz').attr('style','background-color:#f90');
	</script>
	<?php
}
if($_REQUEST['action'] == 'edit_booking'){
	add_action( 'wp_ajax_edit_booking', 'edit_booking_callback');
	include_once('edit_booking.php');
}

if($_REQUEST['action'] == 'getworkinghours'){
	add_action( 'wp_ajax_getworkinghours', 'getworkinghours_callback');
	include_once('getworkinghours.php');
}
if($_REQUEST['action'] == 'datafeed'){
	add_action( 'wp_ajax_datafeed', 'datafeed_callback');
	include_once('php/datafeed.php');
}

if($_REQUEST['action'] == 'online_booking'){
	add_action( 'wp_ajax_online_booking', 'online_booking_callback');
	include_once('online_booking.php');
}

if($_REQUEST['action'] == 'servicehours'){
	add_action( 'wp_ajax_servicehours', 'servicehours_callback');
	add_action( 'wp_ajax_nopriv_servicehours', 'servicehours_callback');	
	include_once('servicehours.php');
}

if($_REQUEST['action'] == 'back_front'){
	add_action( 'wp_ajax_back_front', 'back_front_callback');
	add_action( 'wp_ajax_nopriv_back_front', 'back_front_callback');
	include_once('back-front.php');
}

if($_REQUEST['action'] == 'booking'){
	add_action( 'wp_ajax_booking', 'booking_callback');
	include_once('booking.php');
}

if($_REQUEST['action'] == 'booking_updation'){
	add_action( 'wp_ajax_booking_updation', 'booking_updation_callback');
	add_action( 'wp_ajax_nopriv_booking_updation', 'booking_updation_callback');
	include_once('booking_updation.php');
}

if($_REQUEST['action'] == 'calendar'){
	add_action( 'wp_ajax_calendar', 'calendar_callback');
	add_action( 'wp_ajax_nopriv_calendar', 'calendar_callback');
	include_once('calendar.php');
}
if($_REQUEST['action'] == 'calendar30'){
	add_action( 'wp_ajax_calendar30', 'calendar30_callback');
	add_action( 'wp_ajax_nopriv_calendar30', 'calendar30_callback');
	include_once('calendar30.php');
}
if($_REQUEST['action'] == 'backendbooking_bookingtab'){
	add_action( 'wp_ajax_backendbooking_bookingtab', 'backendbooking_bookingtab_callback');
	include_once('backendbooking_bookingtab.php');
}
if($_REQUEST['action'] == 'sendmail'){
	add_action( 'wp_ajax_sendmail', 'sendmail_callback');
	include_once('sendmail.php');
}
if($_REQUEST['action'] == 'backendbooking'){
	add_action( 'wp_ajax_backendbooking', 'backendbooking_callback');
	include_once('backendbooking.php');
}
if($_REQUEST['action'] == 'radio'){
	add_action( 'wp_ajax_radio', 'radio_callback');
	include_once('radio.php');
}
if($_REQUEST['action'] == 'booking_form'){
	add_action( 'wp_ajax_booking_form', 'booking_form_callback');
	include_once('booking_form.php');
}
if($_REQUEST['action'] == 'confirm_disapprove'){
	add_action( 'wp_ajax_confirm_disapprove', 'confirm_disapprove_callback');
	include_once('confirm_disapprove.php');
}
if($_REQUEST['action'] == 'confirm'){
	add_action( 'wp_ajax_confirm', 'confirm_callback');
	include_once('confirm.php');
}

if($_REQUEST['action'] == 'blocktim'){
	add_action( 'wp_ajax_blocktim', 'blocktim_callback');
	include_once('blocktim.php');
}
if($_REQUEST['action'] == 'getlasthour'){
	add_action( 'wp_ajax_getlasthour', 'getlasthour_callback');
	include_once('getlasthour.php');
}
if($_REQUEST['action'] == 'book'){
	add_action( 'wp_ajax_book', 'book_callback');
	include_once('book.php');
}
if($_REQUEST['action'] == 'bookingstatus'){
	add_action( 'wp_ajax_bookingstatus', 'bookingstatus_callback');
	include_once('bookingstatus.php');
}
if($_REQUEST['action'] == 'resendbooking'){
	add_action( 'wp_ajax_resendbooking', 'resendbooking_callback');
	include_once('resendbooking.php');
}
if($_REQUEST['action'] == 'customer'){
	add_action( 'wp_ajax_customer', 'customer_callback');
	include_once('customer.php');
}
if($_REQUEST['action'] == 'customer_booking'){
	add_action( 'wp_ajax_customer_booking', 'customer_booking_callback');
	include_once('customer_booking.php');
}
if($_REQUEST['action'] == 'customersrebind'){
	add_action( 'wp_ajax_customersrebind', 'customersrebind_callback');
	include_once('customersrebind.php');
}
if($_REQUEST['action'] == 'cont'){
	add_action( 'wp_ajax_cont', 'cont_callback');
	include_once('cont.php');
}
if($_REQUEST['action'] == 'email'){
	add_action( 'wp_ajax_email', 'email_callback');
	include_once('email.php');
}
if($_REQUEST['action'] == 'front_bookinglink'){
	add_action( 'wp_ajax_front_bookinglink', 'front_bookinglink_callback');
	add_action( 'wp_ajax_nopriv_front_bookinglink', 'front_bookinglink_callback');
	include_once('front_bookinglink.php');
}
if($_REQUEST['action'] == 'setting'){
	add_action( 'wp_ajax_setting', 'setting_callback');
	include_once('setting.php');
}
if($_REQUEST['action'] == 'settingrebind'){
	add_action( 'wp_ajax_settingrebind', 'settingrebind_callback');
	include_once('settingrebind.php');
}
if($_REQUEST['action'] == 'services'){
	add_action( 'wp_ajax_services', 'services_callback');
	include_once('services.php');
}
if($_REQUEST['action'] == 'servicerebind'){
	add_action( 'wp_ajax_servicerebind', 'servicerebind_callback');
	include_once('servicerebind.php');
}
if($_REQUEST['action'] == 'employee_allocation'){
	add_action( 'wp_ajax_employee_allocation', 'employee_allocation_callback');
	include_once('employee_allocation.php');
}
if($_REQUEST['action'] == 'employees'){
	add_action( 'wp_ajax_employees', 'employees_callback');
	include_once('employees.php');
}
if($_REQUEST['action'] == 'employeesrebind'){
	add_action( 'wp_ajax_employeesrebind', 'employeesrebind_callback');
	include_once('employeesrebind.php');
}
if($_REQUEST['action'] == 'blockcal'){
	add_action( 'wp_ajax_blockcal', 'blockcal_callback');
	include_once('block_cal.php');
}
if($_REQUEST['action'] == 'block_cal'){
	add_action( 'wp_ajax_block_cal', 'block_cal_callback');
	include_once('blockcal.php');
}
if($_REQUEST['action'] == 'blockdatedelete'){
	add_action( 'wp_ajax_blockdatedelete', 'blockdatedelete_callback');
	include_once('blockdatedelete.php');
}
function sm_tab_booking()
{	
	require_once 'header.php';
	include_once ("sample.php");
	include_once ("bookingstatus.php");
	bookingstatus_callback();
	include_once ("customer_booking.php");
	customer_booking_callback();
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabBooking').attr('style','background-color:#f90');
	</script>
	<?php
}

function sm_tab_employee()
{
	require_once 'header.php';	
	include_once ("employees.php");
	employees_callback();
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabEmployees').attr('style','background-color:#f90');
	</script>
	<?php
	
}

function sm_tab_service()
{
	require_once 'header.php';
	include_once ("services.php");
	services_callback();
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabServices').attr('style','background-color:#f90');
	
	</script>
	<?php
	
}

function sm_tab_customer()
{
	require_once 'header.php';
	include_once ("customer.php");
	customer_callback();
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabCustomers').attr('style','background-color:#f90');
	</script>
	<?php
	
}

function sm_tab_nofification()
{
	require_once 'header.php';
	include_once ("notification.php");
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabNotifications').attr('style','background-color:#f90');
	</script>
	<?php
}

function sm_tab_email()
{
	require_once 'header.php';
	include_once ("email.php");
	email_callback();
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabEmail').attr('style','background-color:#f90');
	</script>
	<?php
}

function sm_tab_export()
{
	require_once 'header.php';
	include_once ("exports.php");
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabExports').attr('style','background-color:#f90');
	</script>
	<?php
}

function sm_tab_bookings()
{
	require_once 'header.php';
	include_once ("booking_form.php");
	booking_form_callback();
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabBookings').attr('style','background-color:#f90');
	</script>
	<?php
}

function sm_tab_bookinglink()
{
	require_once 'header.php';
	include_once ("booking_link.php");
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabBookingsLink').attr('style','background-color:#f90');
	</script>
	<?php
}

function sm_tab_setting()
{
	require_once 'header.php';
	include_once ("setting.php");
	setting_callback();
	require_once 'footer.php';
	?>
	<script>
	jQuery('#TabSettings').attr('style','background-color:#f90');
	</script>
	<?php
}

?>