<?php
/*
Thinkedit 2.0 by Philippe Jadin and Pierre Lecrenier


Main displays the homepage of the user
*/



include_once('common.inc.php');

//check_user
check_user();




// generating the modules list from the config array
$i=0;
$j=0;
$k=0;
$l=0;
foreach($config['config']['module'] as $key=>$module)
{

  if (!isset($module['type']))
  {
    $module['type'] = 'list';
  }


  // only show modules we want to in the config files
  if  ((!$module['use']['homepage'] == 'false') and ($module['type'] == 'list'))
  {

    $out['modules'][$i]['type'] = $module['type'];
    $out['modules'][$i]['title'] = $module['title'][$interface_locale];
    $out['modules'][$i]['help'] = $module['help'][$interface_locale];
    $out['modules'][$i]['icon'] = $module['icon'];
    $out['modules'][$i]['id'] = $key;
    if ($module['use']['buttons']=='false')
    {
      $out['modules'][$i]['buttons'] = 'false';
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

    /*
    <!-- use last modified on home page ?

    if yes, add a timestamp field called last_modified
    -->

    <last_modified>true</last_modified>

    */

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
        $out['modules'][$i]['items'][$x]['title'] = strip_tags(substr($item->$module['title_row'], 0, 15)) . "...";
        $out['modules'][$i]['items'][$x]['id'] = $item->id;
        $out['modules'][$i]['items'][$x]['locale'] = $item->locale;
        $x++;
      }


    }

    $i++;

  }




  // only show modules we want to in the config files
  if  ((!$module['use']['homepage'] == 'false') and ($module['type'] == 'minilist'))
  {

    $out['minilist_modules'][$j]['type'] = $module['type'];
    $out['minilist_modules'][$j]['title'] = $module['title'][$interface_locale];
    $out['minilist_modules'][$j]['help'] = $module['help'][$interface_locale];
    $out['minilist_modules'][$j]['icon'] = $module['icon'];
    $out['minilist_modules'][$j]['id'] = $key;

    $j++;

  }


  // only show modules we want to in the config files
  if  ((!$module['use']['homepage'] == 'false') and ($module['type'] == 'filemanager'))
  {

    $out['filemanager_modules'][$k]['type'] = $module['type'];
    $out['filemanager_modules'][$k]['title'] = $module['title'][$interface_locale];
    $out['filemanager_modules'][$k]['help'] = $module['help'][$interface_locale];
    $out['filemanager_modules'][$k]['icon'] = $module['icon'];
    $out['filemanager_modules'][$k]['id'] = $key;
    $k++;

  }






}


//$out['welcome_message'] = $config['config']['site']['help'][$interface_locale];



// generates the breadcrumb data


$out['breadcrumb'][0]['title'] = '';
$out['breadcrumb'][0]['url'] = 'main.php';


// describes the banner :
$out['banner']['needed'] = true;
$out['banner']['title'] = translate('welcome_msg');
$out['banner']['message'] = $config['config']['site']['help'][$interface_locale];
$out['banner']['image'] = 'icons/icon_banner.gif';

if ($debug) print_a($out);


//print_a($out);
// include the templates

include('header.template.php');
include('main.template.php');
include('footer.template.php');

?>

