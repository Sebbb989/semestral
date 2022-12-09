<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <h1 class="mb-2 bread">Administrar Platos</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Inicio <i class="ion-ios-arrow-forward"></i></a></span> <span>Administrar Platos <i class="ion-ios-arrow-forward"></i></span></p>
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
            <h2 class="mb-4">Listado de Platos</h2>
          </div>
          <div class="row">
            <div class="col-md-12">
            <?php if (isset($msg)){?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Excelente</strong> <?php echo $msg?>
 						</div>
					<?php }?>
              <a href="<?php echo "index.php?c=" . seg::codificar("plato") . "&m=" . seg::codificar("registro") ?>"><button type="button" class="btn btn-success btn-lg">Agregar Plato</button></a>
              <br><br>

              <table class="table table-light   table-hover table-bordered table-sm table-responsive-sm">
                <thead>

                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Fecha Creacion</th>
                    <th scope="col">Fecha Actualizacion</th>
                    <th scope="col">Acciones</th>
                  </tr>

                </thead>
                <tbody>
                  <?php foreach ($resultado as $r) { ?>
                    <tr>
                      <td><?php echo $r->nombre_plato ?></td>
                      <td><?php echo $r->descripcion_plato ?></td>
                      <td>$<?php echo $r->precio_plato ?></td>
                      <td><img src="<?php echo $r->foto_plato ?>" alt="" style="width:100px"></td>
                      <td><?php echo $r->fecha_creacion ?></td>
                      <td><?php echo $r->fecha_actualizacion ?></td>

                      <td><a href="<?php echo "index.php?c=" . seg::codificar("plato") . "&m=" . seg::codificar("modificar") . "&id=" . $r->_id ?>"><button type="button" class="btn btn-primary btn-sm">Modificar</button></a>
                        <a href="<?php echo "index.php?c=" . seg::codificar("plato") . "&m=" . seg::codificar("eliminar") . "&id=" . $r->_id ?>"><button type="button" class="btn btn-danger btn-sm">Eliminar</button></a>
                      </td>

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