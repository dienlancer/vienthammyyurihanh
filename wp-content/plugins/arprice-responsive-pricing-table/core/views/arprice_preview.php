<?php

function arplite_my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'arplite_my_function_admin_bar');
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php bloginfo('name'); ?></title>

<?php 
global $arplite_pricingtable;

$arplite_pricingtable->set_front_css();
$arplite_pricingtable->set_front_js();

$upload_main_url 	= ARPLITE_PRICINGTABLE_UPLOAD_URL.'/css';

wp_print_scripts();
?>
<link rel="stylesheet" href="<?php echo ARPLITE_PRICINGTABLE_URL.'/css/font-awesome.css'?>" type="text/css">
<link rel="stylesheet" href="<?php echo ARPLITE_PRICINGTABLE_URL.'/css/arprice_front.css'?>" type="text/css"> 
<link rel="stylesheet" href="<?php echo ARPLITE_PRICINGTABLE_URL.'/fonts/arp_fonts.css' ?>" type="text/css">

<style type="text/css">
input, select, textarea { outline:none; }
body{ padding:20px; }
.bestPlanButton{
	cursor:pointer;
}
html{
	overflow-y:auto;
	float:left;
	width:100%;
	height:auto;
	padding-top:0px;
}
/*@media screen and (max-width:380px){
	html{
		width:88%;
	}
}*/
.arp_body_content
{
	background:none; 
	background-color:#FFFFFF; 
	padding:20px 30px 20px 30px; 
	margin:20px 0 0; 
	overflow:hidden; 
	width:100%;
	-webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
	-o-box-sizing:border-box;
    box-sizing: border-box;
	float:left;
	height:auto;
	
}
<?php 
$mobile_size = get_option('arplite_mobile_responsive_size');
$tablet_size = get_option('arplite_tablet_responsive_size');
 echo "@media screen and (min-width:".($mobile_size + 1)."px) and (max-width:".$tablet_size."px){
	.arp_body_content
	{
		padding: 20px 15px 20px 15px; 	
	}
}";
?>
</style>
</head>

<body class="arp_body_content">
<?php 

require_once ARPLITE_PRICINGTABLE_DIR.'/core/views/arprice_front.php';

if(isset($_REQUEST['home_view']) && $_REQUEST['home_view'] == '1') {
    $contents = arplite_get_pricing_table_string( $table_id, @$pricetable_name, 2 );    
} else {
    $contents = arplite_get_pricing_table_string( $table_id, @$pricetable_name, 1 );
}


$contents = apply_filters('arplite_predisplay_pricingtable', $contents, $table_id);
				
echo $contents;

?>
<?php 
if( @$opts )
{
	$googlemap = 0;
	if( $opts['columns'] )
	{
		foreach( $opts['columns'] as $columns )
		{
			$html_content	= $columns['arp_header_shortcode'];
			if( preg_match('/arp_googlemap/', $html_content) )
				$googlemap = 1;														
		}	
	}
}
?>
</body>

</html>