<?php
/*
Plugin Name: Change Search Parameter
Version: 1.0.0
Description: Replace or Change Default Search Query Parameter With Your Custom Parameter.
Author: Pritesh Gupta
Author URI: http://www.priteshgupta.com
Plugin URI: http://www.priteshgupta.com/plugins/change-search-parameter
License: GPL
*/

/*  Copyright (C) 2011  Pritesh Gupta {http://www.priteshgupta.com/plugins/change-search-parameter}

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php 
        add_action('activate_search_parameter.php', 'search_parameter');
		function search_parameter(){
			add_option("search_parameter", 'search');
			add_option("search_parameter_display", 'yes');
		}
	add_action('wp_head', 'search_parameter_session');
	function search_parameter_session(){$_SESSION['search_parameter_nri'] = 0;}
	
    add_action('admin_menu', 'search_parameter_menu');
    function search_parameter_menu() {
        if (function_exists('add_options_page')) {
            add_options_page('Change Search Parameter', 'Change Search Parameter', 9, 'search_parameter', 'search_parameter_display');
        }
    }
    function search_parameter_display(){
		
        if($_POST['Submit']){
			$search_parameter = $_POST['search_parameter'];
			update_option("search_parameter", $search_parameter);
			update_option("search_parameter_display", $_POST['search_parameter_display']);
			
			echo '<div id="message" class="updated fade"><p>Update Successful!</p></div>';
		}
		$output = '<form method="post" action="'.$_SERVER['REQUEST_URI'].'">';
		?>
	<style type="text/css">
	.author{
	text-decoration:none;
	}
		
	table{
	width:60%;
	border-collapse:collapse;
	table-layout:auto;
	vertical-align:top;
	margin-bottom:15px;
	border:1px solid #CCCCCC;
	}

	table thead th{
	color:#FFFFFF;
	background-color:#666666;
	border:1px solid #CCCCCC;
	border-collapse:collapse;
	text-align:center;
	table-layout:auto;
	vertical-align:middle;
	}

	table tbody td{
	vertical-align:top;
	border-collapse:collapse;
	border-left:1px solid #CCCCCC;
	border-right:1px solid #CCCCCC;
	}
	
	table thead th, table tbody td{
	padding:5px;
	border-collapse:collapse;
	}

	table tbody tr.light{
	color:#333333;
	background-color:#F7F7F7;
	}

	table tbody tr.dark{
	color:#333333;
	background-color:#E8E8E8;
	}
	
	input[type=text]{
	background: #cecdcd; /* Fallback */
	background: rgba(206, 205, 205, 0.6);
	border: 2px solid #666;
	padding: 6px 5px;
	line-height: 1em;
	-webkit-box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	-moz-box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	-webkit-border-radius: 8px !important; 
	-moz-border-radius: 8px !important;
	border-radius: 8px !important; 
	margin-bottom: 10px;
	width: 300px;
	}
	
	select{
	background: #cecdcd; /* Fallback */
	background: rgba(206, 205, 205, 0.6);
	border: 2px solid #666;
	padding: 6px 5px;
	height: 2.8em !important;
	-webkit-box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	-moz-box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	box-shadow: inset -1px 1px 1px rgba(255, 255, 255, 0.65);
	-webkit-border-radius: 8px !important; 
	-moz-border-radius: 8px !important;
	border-radius: 8px !important; 
	margin-bottom: 10px;
	width: 300px;
	text-align:center;
	}
	
	</style>
		<?php
		$output .= '<div class="wrap">'."\n";
		$output .= '	<div id="icon-plugins" class="icon32"></div><h2>Change Search Parameter Plugin Options</h2>'."\n";
		$output .= '	by <strong><a href="http://www.priteshgupta.com" target="_blank" class="author">Pritesh Gupta</a></strong> || <a href="http://www.priteshgupta.com/plugins/change-search-parameter" target="_blank" class="author"><strong>Visit Release Page</strong></a>'."\n";
		$output .= '	<br /> <br />'."\n";
		$output .= '	<table border="0" cellspacing="0" cellpadding="6">'."\n";
		
		$search_parameter_display = get_option('search_parameter_display');
		$output .= '		<tr class="light">'."\n";
		$output .= '			<td width="75%">Enable Search Query Parameter Replacement?</td>'."\n";
		$output .= '			<td width="25%">';
		$output .= '				<select name="search_parameter_display">'."\n";
		$output .= '					<option value="yes"';if ($search_parameter_display == 'yes') $output .= 'selected="selected"';$output .= '>Yes</option>'."\n";
		$output .= '					<option value="no"';if ($search_parameter_display == 'no') $output .= 'selected="selected"';$output .= '>No</option>'."\n";
		$output .= '				</select>'."\n";
		$output .= '			</td>';
		$output .= '		</tr>'."\n";
		$output .= '		<tr class="dark">'."\n";
		$output .= '			<td width="75%">Enter Search Query Parameter(Should not conflict with any built-in variable): </td>'."\n";
		$output .= '			<td width="25%"><input type="text" name="search_parameter" value="'.get_option('search_parameter','search').'" /></td>';
		$output .= '		</tr>'."\n";

		$output .= '	</table>'."\n";
		$output .= "\n";
		$output .= '				<input type="submit" name="Submit" class="button-primary" value="Update Options &raquo;" />&nbsp;&nbsp;'."\n";
		$output .= '</form>';
		$output .= '</div>'."\n";
        echo $output;
    }
if (get_option("search_parameter_display", "yes") == 'yes'){
function new_search_parameter( $allowed_query_vars ) {
        $allowed_query_vars[] = get_option("search_parameter", "search");
        return $allowed_query_vars;
}
add_filter('query_vars', 'new_search_parameter' );
function swap_search_parameter($query_string) {
        $query_string_array = array();
        parse_str($query_string, $query_string_array); 
        if(isset($query_string_array[get_option("search_parameter", "search")])){
                $query_string_array['s'] = $query_string_array[get_option("search_parameter", "search")];
                unset($query_string_array[get_option("search_parameter", "search")]);
        }
        return http_build_query($query_string_array, '', '&');
}
add_filter('query_string', 'swap_search_parameter');
function change_search_parameter() {
	if ( is_search() && ! empty( $_GET['s'] ) ) {
		wp_redirect( home_url( '?'.get_option("search_parameter", "search").'=' ) . urlencode( get_query_var( 's' ) ) );
		exit();
	}
}
add_action( 'template_redirect', 'change_search_parameter' );
}