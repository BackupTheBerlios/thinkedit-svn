<?php

/*
Thinkedit main menu
*/

?>


<style type="text/css">

body {
	font-family: arial, helvetica, serif;
}

ul { /* all lists */
	padding: 0;
	margin: 0;
	list-style: none;
}

li { /* all list items */
	float: left;
	position: relative;
	width: 10em;
}

li ul { /* second-level lists */
	display: none;
	position: absolute;
	top: 1em;
	left: 0;
	border: 1px solid black;
}

li>ul { /* to override top and left in browsers other than IE, which will position to the top right of the containing li, rather than bottom left */
	top: auto;
	left: auto;
}

li:hover ul, li.over ul { /* lists nested under hovered list items */
	display: block;
}

#content {
	clear: left;
}

</style>

<script type="text/javascript"><!--//--><![CDATA[//><!--

startList = function() {
	if (document.all&&document.getElementById) {
		navRoot = document.getElementById("nav");
		for (i=0; i<navRoot.childNodes.length; i++) {
			node = navRoot.childNodes[i];
			if (node.nodeName=="LI") {
				node.onmouseover=function() {
					this.className+=" over";
				}
				node.onmouseout=function() {
					this.className=this.className.replace(" over", "");
				}
			}
		}
	}
}
window.onload=startList;

//--><!]]></script>



<ul>
  <li>Contenu
    <ul>
      <li><a href="">Blackbande sunfish</a></li>
      <li><a href="">Shadow bass</a></li>
      <li><a href="">Ozark bass</a></li>
      <li><a href="">White crappie</a></li>
		</ul>
	</li>

  <li>Fichiers
    <ul>
      <li><a href="">Smallmouth grunt
        </a></li>
      <li><a href="">Burrito</a></li>
      <li><a href="">Pigfish</a></li>
    </ul>
  </li>

  <li>Structure
    <ul>
      <li><a href="">Whalesucker</a></li>
      <li><a href="">Marlinsucker</a></li>
      <li><a href="">Ceylonese remora</a></li>
      <li><a href="">Spearfish remora</a></li>
      <li><a href="">Slender suckerfish</a></li>
    </ul>
  </li>
  
  
  <li>Aide
    <ul>
      <li><a href="">Whalesucker</a></li>
      <li><a href="">Marlinsucker</a></li>
      <li><a href="">Ceylonese remora</a></li>
      <li><a href="">Spearfish remora</a></li>
      <li><a href="">Slender suckerfish</a></li>
    </ul>
  </li>
  
  
  
</ul>



