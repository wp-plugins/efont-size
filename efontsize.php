<?php
if ('efontsize.php' == basename($_SERVER['SCRIPT_FILENAME']))
     die ('<h2>Direct File Access Prohibited</h2>');
/*
Plugin Name: eFont Size
Plugin URI: http://www.quirm.net/
Description: A font resizer
Version: 0.0.2
Author: Rich Pedley 
Author URI: http://elfden.co.uk/

    Copyright 2008  RICH PEDLEY  (email : elfin@elfden.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

ob_start();

if (!function_exists('efontsize_wp_head')) {

    function efontsize_wp_head() {
    	//this needs setting to be your default body font size in % it must be numeric

    	$fontsize=get_option('efontsize');
    	if(!is_numeric($fontsize))
   			$fontsize=100.1;
   			
    	if(isset($_COOKIE["efontsize"])){
			$stuff=explode("::",$_COOKIE["efontsize"]);
		}else{
			$stuff[0]='font-size';
			$stuff[1]=$fontsize;
		}

    	if(isset($_GET['incfont']) || isset($_GET['decfont'])){
			if(isset($_GET['incfont']) && $_GET['incfont']='yes')
				$stuff[1]=$stuff[1]+20;
			if(isset($_GET['decfont']) && $_GET['decfont']='yes')
				$stuff[1]=$stuff[1]-20;
			
			if($stuff[1]<1) $stuff[1]=0;//to stop silly negatives.

			//uncomment this if you want to set max/min font sizes
			//if($stuff[1]>249) $stuff[1]=250.1;
			//if($stuff[1]<51) $stuff[1]=50.1;
			$biscuits='font-size::'.$stuff[1];
			setcookie("efontsize", $biscuits,time()+60*60*24*365,'/');
		}
		if(isset($_GET['resetfont']) && $_GET['resetfont']='yes'){
			$stuff[1]=$fontsize;
			$biscuits='font-size::'.$stuff[1];
			setcookie("efontsize", $biscuits,time()+60*60*24*365,'/');
		}
		//ul.efontsize style will be removed before release.
		echo '<style type="text/css">
		body{'.$stuff[0].':'.$stuff[1].'%;}
		</style>';
		?>
		<?php
		ob_end_flush();

    }
}
if (!function_exists('efontsize')) {
    function efontsize($thefontsize='') {
    	if(isset($thefontsize) && is_numeric($thefontsize))
   			update_option('efontsize', $thefontsize);
		echo '<ul class="efontsize"><li class="efontbig"><a href="'.$PHP_SELF.'?incfont=yes" onclick="window.location.replace(this.href); return false"><span>Bigger text</span></a></li><li class="efontsmall"><a href="'.$PHP_SELF.'?decfont=yes" onclick="window.location.replace(this.href); return false"><span>Smaller text</span></a></li><li class="efontreset"><a href="'.$PHP_SELF.'?resetfont=yes" onclick="window.location.replace(this.href); return false"><span class="?">Reset text</span></a></li></ul>';
    }
}
if (!function_exists('efontsize_install')) {
    function efontsize_install() {
    	add_option('efontsize', '100.1');
    }
}
if (!function_exists('efontsize_deactivate')) {
    function efontsize_deactivate() {
    	delete_option('efontsize');
    }
}
/* activations */
register_activation_hook(__FILE__,'efontsize_install');

/* deactivation */
register_deactivation_hook( __FILE__, 'efontsize_deactivate' );
/* actions */
add_action('wp_head', 'efontsize_wp_head');
?>