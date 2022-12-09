<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <h1 class="mb-2 bread">Administrar Pagos</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Inicio <i class="ion-ios-arrow-forward"></i></a></span> <span>Administrar Pagos <i class="ion-ios-arrow-forward"></i></span></p>
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
            <h2 class="mb-4">Listado de Pagos</h2>
          </div>
          <div class="row">
            <div class="col-md-12">
            <?php if (isset($msg)){?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Excelente</strong> <?php echo $msg?>
 						</div>
					<?php }?>


              <table class="table table-light   table-hover table-bordered table-sm table-responsive-sm">
                <thead>

                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ID Usuario</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Cuenta Paypal</th>
                    <th scope="col">Monto Pago</th>
                  </tr>

                </thead>
                <tbody>
                  <?php foreach ($resultado as $r) { ?>
                    <tr>
                      <td><?php echo $r["_id"] ?></td>
                      <td><?php echo $r["id_usuario"] ?></td>
                      <td><?php echo $r["usuario"] ?></td>
                      <td><?php echo $r["correo"] ?></td>
                      <td><?php echo $r["cuenta_paypal"] ?></td>
                      <td><?php echo $r["monto_pago"] ?></td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>




          </div>
        </div>
      </div>
    </div>
  </div>

  </div>
  </div>
</section>