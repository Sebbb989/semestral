<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-2 bread">Información</h1>
				<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Inicio <i class="ion-ios-arrow-forward"></i></a></span> <span>Información <i class="ion-ios-arrow-forward"></i></span></p>
			</div>
		</div>
	</div>
</section>
<section class="ftco-section ftco-wrap-about ftco-no-pb">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-10 wrap-about ftco-animate text-center">
				<div class="heading-section mb-4 text-center">
					<span class="subheading">Codigo QR</span>
					<h2 class="mb-4">Codigo QR</h2>

					<h2 class="mb-4"></h2>
				</div>
				<p><?php echo $url . "<br>" ?></p>
				<div style="margin-left: auto;margin-right: auto;display: block;"><img src="<?php echo utils::generarqr($url) ?>" alt="">
					<br><a href="<?php echo utils::generarqr($url) ?>" target="_blank"><button type="button" class="btn btn-primary">Descargar</button></a>
				</div>

			</div>
		</div>

	</div>
</section>
<br><br>