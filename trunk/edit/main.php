<?php
/*
Thinkedit 2.0 by Philippe Jadin and Pierre Lecrenier


Main displays the homepage of the user
*/



include_once('common.inc.php');

//check_user
check_user();


$config_tool = $thinkedit->newConfig();
$tables = $config_tool->getTableList();


// generating the table list from the config array
$i=0;
$j=0;
$k=0;
$l=0;
foreach($tables as $table_id)
{
		
		$table = $thinkedit->newTable($table_id);
		$out['table'][$i]['type'] = 'list';
		$out['table'][$i]['title'] = $table->getTitle();
		$out['table'][$i]['help'] = $table->getHelp();
		$out['table'][$i]['icon'] = $table->getIcon();
		// $out['table'][$i]['id'] = $table->getTableName();
		$out['table'][$i]['uid'] = $table->getUid();
		$out['table'][$i]['list_url'] = $url->linkTo($table, 'list.php');
		
		$i++;
}

/*
// only show table we want to in the config files
if  ((!$module['use']['homepage'] == 'false') and ($module['type'] == 'list'))
{
		
    $out['table'][$i]['type'] = $module['type'];
    $out['table'][$i]['title'] = $module['title'][$interface_locale];
    $out['table'][$i]['help'] = $module['help'][$interface_locale];
    $out['table'][$i]['icon'] = $module['icon'];
    $out['table'][$i]['id'] = $key;
    if ($module['use']['buttons']=='false')
    {
				$out['table'][$i]['buttons'] = 'false';
    }
		
		
    // query items to show titles on the front page
		
    if ($module['locale']['type'] == 'multilingual')
    {
				$where_clause = " where locale='$preferred_locale' ";
    }
    else
    {
				$where_clause = "";
    }
		
    // enable last_modified (see config.xml)
		
		
		
    if ($module['last_modified'] == 'true')
    {
				$order_clause = " order by 'last_modified' desc ";
    }
    else
    {
				$order_clause = "";
    }
		
    $query = "select *  from ".  $module['table'] . $where_clause . $order_clause .  " limit 5";
    debug($query);
    $items = $db->get_results($query);
    if ($debug) $db->debug();
		
    if ($db->num_rows > 0)
    {
				$x=0;
				foreach ($items as $item)
				{
						$out['table'][$i]['items'][$x]['title'] = strip_tags(substr($item->$module['title_row'], 0, 15)) . "...";
						$out['table'][$i]['items'][$x]['id'] = $item->id;
						$out['table'][$i]['items'][$x]['locale'] = $item->locale;
						$x++;
				}
				
				
    }
		
    $i++;
		
}




// only show table we want to in the config files
if  ((!$module['use']['homepage'] == 'false') and ($module['type'] == 'minilist'))
{
		
    $out['minilist_table'][$j]['type'] = $module['type'];
    $out['minilist_table'][$j]['title'] = $module['title'][$interface_locale];
    $out['minilist_table'][$j]['help'] = $module['help'][$interface_locale];
    $out['minilist_table'][$j]['icon'] = $module['icon'];
    $out['minilist_table'][$j]['id'] = $key;
		
    $j++;
		
}


// only show table we want to in the config files
if  ((!$module['use']['homepage'] == 'false') and ($module['type'] == 'filemanager'))
{
		
    $out['filemanager_table'][$k]['type'] = $module['type'];
    $out['filemanager_table'][$k]['title'] = $module['title'][$interface_locale];
    $out['filemanager_table'][$k]['help'] = $module['help'][$interface_locale];
    $out['filemanager_table'][$k]['icon'] = $module['icon'];
    $out['filemanager_table'][$k]['id'] = $key;
    $k++;
		
}



*/





//$out['welcome_message'] = $config['config']['site']['help'][$interface_locale];



// generates the breadcrumb data


$out['breadcrumb'][0]['title'] = '';
$out['breadcrumb'][0]['url'] = 'main.php';


// describes the banner :
$out['banner']['needed'] = true;
$out['banner']['title'] = translate('welcome_msg');
$out['banner']['message'] = $thinkedit->getHelp();
$out['banner']['image'] = 'ressource/image/general/icon_banner.gif';

debug($out);


//print_a($out);
// include the templates

include('header.template.php');
include('main.template.php');
include('footer.template.php');

?>

