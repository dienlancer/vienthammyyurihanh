<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function arp_upgrade_to_premium_menu()
{
    $page_hook = add_submenu_page('arpricelite', __('Upgrade to Premium','ARPricelite'),__('Upgrade to Premium','ARPricelite'), 'arplite_view_pricingtables','arplite_upgrade_to_premium', 'arp_upgrade_to_premium' );
    add_action('load-' . $page_hook , 'arp_upgrade_ob_start');
}
add_action('admin_menu', 'arp_upgrade_to_premium_menu','28');

function arp_upgrade_ob_start() {
    ob_start();
}

function arp_upgrade_to_premium()
{
	global $arpricelite_version;
    wp_redirect('http://arprice.arformsplugin.com/premium/upgrade_to_premium.php?rdt=t1&arp_version='.$arpricelite_version.'&arp_request_version='.get_bloginfo('version'), 301);
    exit();
}

function arp_upgrade_to_premium_menu_js()
{
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function ($) {
            $('a[href="admin.php?page=arplite_upgrade_to_premium"]').on('click', function () {
        		$(this).attr('target', '_blank');
            });
        });
    </script>
    
    <?php 
}
add_action( 'admin_footer', 'arp_upgrade_to_premium_menu_js');
?>