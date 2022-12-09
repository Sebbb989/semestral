<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-2 bread">Administrar Categorias</h1>
				<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Inicio <i class="ion-ios-arrow-forward"></i></a></span> <span>Administrar Categorias <i class="ion-ios-arrow-forward"></i></span></p>
			</div>
		</div>
	</div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb">
	<div class="container-fluid px-0">
		<div class="row d-flex no-gutters">
			<div class="col-md-12 order-md-last ftco-animate makereservation p-4 p-md-5 pt-5">
				<div class="py-md-5">
					<div class="heading-section ftco-animate mb-5">
						<h2 class="mb-4">Agregar Categoria</h2>
					</div>
					<form method="POST" action="<?php echo "index.php?c=" . seg::codificar("categoria_plato") . "&m=" . seg::codificar("insertar") ?>">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Descripcion <span class="text-danger">(*)</span></label>
									<input type="text" class="form-control" placeholder="Descripción de categoria" name="txtDescripcion" value="<?php echo isset($resultados["descripcion"]) ? $resultados["descripcion"] : "" ?>">
									<span class="text-danger"><?php echo isset($error[0]) ? $error[0] : "" ?></span>

								</div>
							</div>


							<div class="col-md-12 mt-12">
								<input type="hidden" name="token" value="<?php echo seg::getToken() ?>">

								<div class="form-group">
									<div class="row">
										<div class="col-md-6"><span class="text-danger">(*) Obligatorio</span></div>
										<br><br>
									</div>
									<input type="submit" value="Agregar >" class="btn btn-success py-3 px-5">

								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>