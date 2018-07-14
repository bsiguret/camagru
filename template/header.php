<div id="header">
	<div class="home" onclick="location.href='index.php'">
				<span>
					Camagru
				</snap>
	</div>
	<?php if(isset($_SESSION['id'])) { ?>
			<div class="button" onclick="location.href='controller/disconnect.php'">
				<span>
					Disconnect
				</snap>
			</div>
	<?php } else { ?>
		<div class="button" onclick="location.href='index.php'">
			<span>
				Login
			</snap>
		</div>
	<?php } ?>
	<?php if(isset($_SESSION['id'])) { ?>
	<div class="button" onclick="location.href='montage.php'">
		<span>
			Montage
		</snap>
	</div>
	<?php } ?>
	<div class="button" onclick="location.href='views.php'">
		<span>
			Views
		</snap>
	</div>
	<?php if(isset($_SESSION['id'])) { ?>
	<div class="button" onclick="location.href='account.php'">
		<span>
			Account
		</snap>
	</div>
	<?php } ?>
</div>
