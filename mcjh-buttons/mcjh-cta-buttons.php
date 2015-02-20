<?php

defined('ABSPATH') or die("No script kiddies please!");

/*

Plugin Name: mcjh button shortcode

Plugin URI: http://www.mcjh-medien.de/plugin-shortcode-buttons/

Description: Vielfältige Buttons erstellen, ausschließlich durch Shortcodes

Version: 1.1

Author: Marcus C. J. Hartmann

Author URI: http://www.mcjh-medien.de/

License: GPLv2



Copyright 2014  Marcus C. J. Hartmann  (email : info@mcjh-medien.de)



This program is free software; you can redistribute it and/or modify

it under the terms of the GNU General Public License, version 2, as 

published by the Free Software Foundation.



This program is distributed in the hope that it will be useful,

but WITHOUT ANY WARRANTY; without even the implied warranty of

MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

GNU General Public License for more details.



You should have received a copy of the GNU General Public License

along with this program; if not, write to the Free Software

Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

/*--------------------------------- Include Files ----------------------------------*/

/*--------------------------------- Add CSS to head section ----------------------------------*/

function mcjh_ctabutton_enqueue_scripts()

{

wp_enqueue_style( 'mcjh-cta-buttons', plugins_url('mcjh-ctabutton-plugin.css',__FILE__),'all');

}	

add_action( 'wp_enqueue_scripts', 'mcjh_ctabutton_enqueue_scripts' );

/*--------------------------------- Add CSS to admin ----------------------------------*/

function admin_register_head() {

    $siteurl = get_option('siteurl');

    $url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/mcjh-ctabutton-plugin-admin.css';

    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";

}

add_action('admin_head', 'admin_register_head');

/*--------------------------------- load Languages ----------------------------------*/



function mcjh_ctabutton_load_textdomain() {

  load_plugin_textdomain( 'mcjh-cta-buttons', false, dirname(plugin_basename(__FILE__)).'/lang/'); 

}	

add_action( 'plugins_loaded', 'mcjh_ctabutton_load_textdomain' );



/*--------------------------------- Remove p br filter ----------------------------------*/

remove_filter( 'the_content', 'wpautop' );

add_filter( 'the_content', 'wpautop' , 99);

add_filter( 'the_content', 'shortcode_unautop',100 );



/*--------------------------------- Shortcode for buttons ----------------------------------*/



function CreateButton($atts) {

	$url = get_bloginfo('url');

	  extract(shortcode_atts(array(

      'text' => 'Click here',

	  'link'=> ''.$url.'',

	  'color' => 'green',

   ), $atts));

   

	$name = $text;

   	if (!is_admin()){

		$scrid = get_the_ID();

	}

	else {$scrid = 'admin';}

	

 	if ($color == 'blue'){

	   $backgroundPath = plugins_url('/bg/button_blue.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'darkblue'){

	   $backgroundPath = plugins_url('/bg/button_darkblue.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'green'){

	   $backgroundPath = plugins_url('/bg/button_green.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'darkgreen'){

	   $backgroundPath = plugins_url('/bg/button_darkgreen.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'orange'){

	   $backgroundPath = plugins_url('/bg/button_orange.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'pink'){

	   $backgroundPath = plugins_url('/bg/button_pink.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'purple'){

	   $backgroundPath = plugins_url('/bg/button_purple.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'red'){

	   $backgroundPath = plugins_url('/bg/button_red.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'yellow'){

	   $backgroundPath = plugins_url('/bg/button_yellow.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'lightgrey'){

	   $backgroundPath = plugins_url('/bg/button_lightgrey.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}

	elseif ($color == 'grey'){

	   $backgroundPath = plugins_url('/bg/button_grey.png',__FILE__);
		$backgroundColor = '';
		$backgroundRepeat ='';
		$colorClass = 'mcjh-'.$color.'';
	}
	elseif (strpos($color,'#') !== false) {
		$backgroundPath = plugins_url('/bg/button_trans.png',__FILE__);
		$backgroundColor = 'background-color:'.$color.'';
		$backgroundRepeat ='background-repeat:repeat-x; background-size: auto auto !important';
		$colorClass = 'mcjh-custom-color';
};
		

		
		$background = 'background-image:url('.$backgroundPath.')';

	//replace breaks from "link"

	$text_id = str_ireplace(" ","_",$text);

	$link_id_find =array (".",":"," ");

	$link_id = str_ireplace($link_id_find,"_",$link);

	



return '<a class="ctabutton '.$colorClass.'" id="'.$link_id.'__'.$text_id.'__'.$scrid.'__'.$color.'" href="'.$link.'" target="_blank" style="'.$background.';'.$backgroundColor.';'.$backgroundRepeat.';" >'.$text.'</a>';

}	



function mcjh_ctabutton_register_shortcode() {

	add_shortcode('createButton', 'CreateButton');

}



add_action('init','mcjh_ctabutton_register_shortcode');





/*--------------------------------- Create Menu Page ----------------------------------*/

function mcjh_ctabutton_shortcode_menus() {

    add_options_page(

        'mcjh-cta-button-shortcode-plugin',

		'CTA Button Shortcodes',

		'manage_options',

        'mcjh-cta-button-shortcode-plugin.php',

		'mcjh_build_plugin_settings');

}

add_action("admin_menu", "mcjh_ctabutton_shortcode_menus");



/*--------------------------------- Render Menu Page ----------------------------------*/

function mcjh_build_plugin_settings (){

	if(!current_user_can('manage_options')){

		wp_die(__('You do not have sufficient permission to access this page','mcjh-cta-buttons'));

	}

	if(current_user_can('manage_options')){ ?>

		<div class="mcjh-cta-button-shortcode-wrap">

        <h2 class="icon" ><?php _e('CTA Button Shortcode','mcjh-cta-buttons') ?></h2>

        <p><?php _e('This page is a short explanation how to use the Cta Button Shortcode.','mcjh-cta-buttons') ?><br /><?php _e('Each Hyperlink will get a "/?src=<em>Number</em>?name=<em>button-text</em>"-extension at the end. This extension can be used to analyze traffic and succes of each individual button with services like Google Analytics.','mcjh-cta-buttons') ?><br />

        	<?php _e('This plugin does not send any data or information from this extensions to the Developer or any third-party provider.','mcjh-cta-buttons') ?>

        </p> 

        <div id="index">

        <div id="index-ct">

        <strong><?php _e('Content Directory') ?></strong><br />

       	<ul>

        <li><a href="#CreateButton"><?php _e('Create a default Button','mcjh-cta-buttons')?></a></li>

        <li><a href="#ChangeText"><?php _e('Change the text','mcjh-cta-buttons')?></a></li>

        <li><a href="#ChangeLink"><?php _e('Change the hyperlink','mcjh-cta-buttons')?></a></li>

        <li><a href="#ChangeColor"><?php _e('Change the color','mcjh-cta-buttons')?></a></li>

        <li><a href="#ColorsList"><?php _e('Available Colors','mcjh-cta-buttons')?></a></li>

        <li><a href="#Help"><?php _e('Help and FAQ','mcjh-cta-buttons')?></a></li>

        <li><a href="#ForPros"><?php _e('Some Information for Pros','mcjh-cta-buttons')?></a></li>

        <li><a href="#Motivation"><?php _e("The Developer's Motivation",'mcjh-cta-buttons')?></a></li>

        </ul>

        </div>

        </div>      

        <a id="CreateButton"></a>

        <div id="createButton" class="mcjh-settings">

       	<strong><?php _e('Create a default Button...','mcjh-cta-buttons')?></strong><br />

        <p><?php _e('...by using [createButton] in your Text-Editor.','mcjh-cta-buttons')?></p>

        <?php echo do_shortcode ('[createButton]'); ?>

        <ul>

        <li><?php _e('default-color: green','mcjh-cta-buttons')?></li>

        <li><?php _e('default-text: Click here','mcjh-cta-buttons')?></li>

        <li><?php _e('default-hyperlink: to your Wordpress-Site','mcjh-cta-buttons')?></li>

        </ul>

        </div>

        <a id="ChangeText"></a>

         <div id="change_Text" class="mcjh-settings">

         <strong><?php _e('Change the text of your Button...')?></strong>

		 <p><?php _e('...by adding <em>text="new text"</em> after <em>createButton</em> to your shortcode:','mcjh-cta-buttons')?></p>

         <p>[createButton text="new text"]</p>

         <?php echo do_shortcode ('[createButton text="new text"]'); ?>

        </div>

        <a id="ChangeLink"></a>

        <div id="change_Hyperlink" class="mcjh-settings">

         <strong><?php _e('Change the hyperlink of your Button..','mcjh-cta-buttons')?>.</strong>

       	 <p><?php _e('...by adding <em>link="http://www.google.com"</em> after <em>createButton</em> to your shortcode:','mcjh-cta-buttons')?></p>

         <p>[createButton text="new text" link="http://www.google.com"]</p>

         <?php echo do_shortcode ('[createButton text="new text" link="http://www.google.com"]'); ?>

        </div>

        <a id="ChangeColor"></a>

        <div id="change_Color" class="mcjh-settings">

         <strong><?php _e('Change the color of your Button...','mcjh-cta-buttons')?></strong>

       	 <p><?php _e('...by adding <em>color="blue"</em> after <em>createButton</em> to your shortcode:','mcjh-cta-buttons')?></p>

         <p>[createButton text="new text" link="http://www.google.de" color="blue"]</p>

         <?php echo do_shortcode ('[createButton text="new text" link="http://www.google.de" color="blue"]'); ?>
		<p><strong><?php _e("OR:",'mcjh-cta-buttons')?></strong></p>
        <p><?php _e("Use any valid hexadecimal color code!",'mcjh-cta-buttons')?></p>
        <p>[createButton text="new text" link="http://www.google.de" color="#112233"]</p>
        
          <?php echo do_shortcode ('[createButton text="new text" link="http://www.google.de" color="#112233"]'); ?>
        </div>

        <a id="ColorsList"></a>

        <div id="colors_listed" class="mcjh-settings">

         <strong><?php _e('All button-colors','mcjh-cta-buttons')?></strong>

       	 <p>

         <table>

         <tr>

        <td><?php echo do_shortcode ('[createButton color="blue"]'); ?></td> <td>color="blue"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="darkblue"]'); ?></td><td>color="darkblue"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="green"]'); ?></td><td>color="green"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="darkgreen"]'); ?></td><td>color="darkgreen"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="grey"]'); ?></td><td>color="grey"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="lightgrey"]'); ?></td><td>color="lightgrey"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="orange"]'); ?></td><td>color="orange"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="pink"]'); ?></td><td>color="pink"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="purple"]'); ?></td><td>color="purple"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="red"]'); ?></td><td>color="red"</td>

         </tr>

          <tr>

         <td><?php echo do_shortcode ('[createButton color="yellow"]'); ?></td><td>color="yellow"</td>

         </tr>
          <tr>

         <td><?php echo do_shortcode ('[createButton color="#123456"]'); ?></td><td>color="#123456"<br /><?php _e("or any other valid hexadecimal color code!",'mcjh-cta-buttons')?></td>

         </tr>

         </table>

         

        </p>

        </div>

        <a id="Help"></a>

        <div id="first_aid" class="mcjh-settings">

         <strong><?php _e('First Aid Assistant','mcjh-cta-buttons')?></strong>

       	 <p><?php _e('It might happen, that something does not work the way it is expected to. In this case, please follow these steps:','mcjh-cta-buttons')?></p>

         <p>

         <ol class="first-aid">

         <li><strong><?php _e("Keep calm and don't panic!",'mcjh-cta-buttons')?></strong></li>

         <li><strong><?php _e("The button doesn't even appeare: </strong>Check your shortcode for typing errors. It might say [CraeteButon] instead of [createButton]",'mcjh-cta-buttons')?></li>

         <li><strong><?php _e('There is just the first word of my text: </strong>Check your text. You might forgott some quotationmarks.','mcjh-cta-buttons')?></li>

         <li><strong><?php _e("The hyperlink doesn't work: </strong>Make sure you did not forgett a 'http://' in front of your URL",'mcjh-cta-buttons')?></li>

         <li><strong><?php _e("The button doesn't show my defined color: </strong> Have a look at the colors list.",'mcjh-cta-buttons')?></li>

         <li><strong><?php _e("I can't even read this list: </strong> ...a fail in the matrix!",'mcjh-cta-buttons')?></li>

         </ol>

         </p>

        </div>

        <a id="ForPros"></a>

        <div id="for_pros" class="mcjh-settings">

         <strong><?php _e("Some Information for Pros",'mcjh-cta-buttons')?></strong>

       	 <p><?php _e("Well, there is nothing interessting for pros. So sorry, dude!",'mcjh-cta-buttons')?></p>
                

        </div>

        <a id="Motivation"></a>

        <div id="motivation" class="mcjh-settings">

         <strong><?php _e("The Developer's Motivation",'mcjh-cta-buttons')?></strong>

       	 <p>

         <?php _e("I worked a lot with Wordpress and its plugins in my old company.",'mcjh-cta-buttons')?><br />

         <?php _e('While relaunching our website we wanted to add some so called "cta buttons" (=call to action)','mcjh-cta-buttons')?>.<br />

         <?php _e("They should offer a simple shortcode-system and an easy way for monitoring their success with allready existing tools.",'mcjh-cta-buttons')?><br />

        <?php _e(" We tried many different plugins, but the results never were realy satisfying. Instead, we had compatibility issues.",'mcjh-cta-buttons')?><br />

         <?php _e("After finishing my apprenticeship, I needed those damn cta-Buttons again for my own website. So I startet experimenting around. And in the end, I wrote this little plugin.",'mcjh-cta-buttons')?>

		</p>

        <p> <?php _e("Have a nice day",'mcjh-cta-buttons')?></p>

        <p><em><?php _e("Marcus C. J. Hartmann",'mcjh-cta-buttons')?><em></p>

        </div>

<?php 

	}

}

?>