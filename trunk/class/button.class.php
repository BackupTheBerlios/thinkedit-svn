<?php


class button
{
function button($label, $url)
{
$this->label = $label;
$this->url = $url;
}




function render()
{
$out = '';
$out.= '<form method="post" action="' . $this->url .'">';
$out.= '<input class="button" type="submit" value="' . $this->label .'">';
$out.= '</form>';

return $out;
}


}

?>