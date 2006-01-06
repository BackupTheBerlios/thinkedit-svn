<?

/*
function get_locale()
{
return 'fr';
}

$locale = get_locale();

*/

/*
Returns the translated string from a translation id.
The translations are located in a db, defined in the config file

If the translation is not found in the db, it is inserted,
using the current language.

The id is being returned instead of the real translation

The translation *id* should be in the form
welcome_message : "Welcome to the interface" that's all lower_case, spaces -> underscore. the field id is a unique string id
*/
function translate($id, $html = true)
{
    global $locale_db, $interface_locale;
    $table = 'translations';
    $translation = $locale_db->get_row("SELECT translation FROM $table WHERE id='$id' and locale='$interface_locale'");
    //$translation_db->debug();
    if ($translation)
    {
        if (is_null($translation->translation))
        {
            return "#$id#";
        }
        else
        {
            if ($html)
						  {
						  return htmlentities($translation->translation);
							}
							else
							{
							return $translation->translation;
							}
							
        }
    }
    else
    {
        $locale_db->query("INSERT INTO $table (id, translation, locale) VALUES ('$id', NULL, '$interface_locale')");
        return $id;
    }
}




/*
Returns user language. Custom rules can be implemented here
*/
function get_language()
{
    global $cfg, $HTTP_SERVER_VARS;

    //return $cfg['interface']['default_language'];

    if (in_array (substr($HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'],0,2) , $cfg['interface']['available_languages']))
    {
        return  substr($HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'],0,2);
    }
    else
    {
        return $cfg['interface']['default_language'];
    }
}




?>