<header>
	Explore the Outdoors!
</header>
<nav>
	<ul>
	<?php
		foreach ($content as $page => $location){
			echo "<li><a href='$location?user=".$user."' ".($page==$currentpage?" class='active'":"").">".$page."</a></li>";			
		}
		?>
	</ul>
</nav>
