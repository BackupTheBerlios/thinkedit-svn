<?php
header("Content-type: text/css");
$low = '888';
$medium = 'BBB';
$high = 'CCC';

?>

body
{
background-color: #AAA;
}

body, th, td, p
{
font-size: 10px;
font-family: verdana, sans-serif
}


.panel
{
padding: 1em;
background-color: #<?php echo $medium?>;
border-top: 0.1em solid #<?php echo $high?>;
border-left: 0.1em solid #<?php echo $high?>;
border-bottom: 0.1em solid #<?php echo $low?>;
border-right: 0.1em solid #<?php echo $low?>;
}

.inset
{
padding: 1em;
background-color: #<?php echo $medium?>;
border-top: 1px solid #<?php echo $low?>;
border-left: 1px solid #<?php echo $low?>;
border-bottom: 1px solid #<?php echo $high?>;
border-right: 1px solid #<?php echo $high?>;
}


.white
{
background-color: #FFF;
}

.warning
{
background-color: #D00;
}

.info
{
background-color: #FA0;
}

.separator
{
margin: 10px;
}

.filet
{
border: 1px solid #000
}