<div class="masthead">
	<h3 class="text-muted text-center more-b30"><?php echo $nomeSite;?></h3>
	<nav>
	  <ul class="nav nav-justified">
		<li<?php if($pagina == "index") echo ' class="active"';?>><a href="<?php echo $dominio;?>">Início</a></li>
		<li<?php if($pagina == "alugar") echo ' class="active"';?>><a href="alugar.php">Alugar</a></li>
		<li<?php if($pagina == "dvds") echo ' class="active"';?>><a href="dvds.php">DVD's</a></li>
		<li<?php if($pagina == "clientes") echo ' class="active"';?>><a href="clientes.php">Clientes</a></li>
	  </ul>
	</nav>
</div>