<!--<div class="h-header">
	<div class="h-logo">
	    <a href="home.php">
	        <img class="logo-InstaMayan-home" src="images/LOGO-InstaMayan.png" width="200px">
	    </a>
	</div>
	
	<div class="h-account">
		<a href="perfil.php?username=<?php echo $_SESSION['username'];?>"><?php echo $_SESSION['username'];?>
		
			<img src="images/icons/perfil.png" class="i-icon" width="30" title="Perfil">
		</a>
		<a href="subir.php">
		    <img src="images/icons/mas.png" width="30"class="i-icon" title ="Sube una foto ó video" >
		</a>

		<!--<img src="images/icons/corazon.png" width="30"></a>-->
	<!--	<a href="logout.php">
			<img src="images/icons/close.png" class="i-icon" width="30" title="Cerrar sesión">
		</a>
	</div>
</div>-->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <a class="navbar-brand" href="home.php">
	        <img class="logo-InstaMayan-home" src="images/LOGO-InstaMayan-Horizontal.png" width="300px">
	</a>
	<ul class="navbar-nav menu-items ml-auto">
	    <li class="nav-item">
	        <a class="nav-link" href="perfil.php?username=<?php echo $_SESSION['username'];?>">
			    <img src="images/icons/PERFIL.png" class="i-icon" width="80px" title="Perfil">
	    	</a>   
	    </li>
	    <li class="nav-item">
	        <a class="nav-link" href="subir.php">
		        <img src="images/icons/SUBIR.png" width="80px"class="i-icon" title ="Subir Foto" >
	    	</a>   
	    </li>
	    <li class="nav-item">
	        <a class="nav-link" href="logout.php">
			    <img src="images/icons/SALIR.png" class="i-icon" width="80px" title="Cerrar sesión">
		    </a>  
	    </li>
	</ul>
</nav>