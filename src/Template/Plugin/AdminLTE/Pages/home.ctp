<?php
    use Cake\Routing\Router;
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Painel administrativo
        <small>Página inicial</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content dashboard">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua box-crud" data-ajax data-href="<?= Router::url(['controller' => 'programadores']); ?>">
            <div class="inner">
              <h3><?= (int)$programadores ?></h3>
              <p>Programadores</p>
            </div>
            <div class="icon">
              <i class="fa fa-code"></i>
            </div>
            <a class="small-box-footer">Consultar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green box-crud" data-ajax data-href="<?= Router::url(['controller' => 'analistas']); ?>">
            <div class="inner">
              <h3><?= (int)$analistas ?></h3>

              <p>Analistas</p>
            </div>
            <div class="icon">
              <i class="fa fa-map"></i>
            </div>
            <a class="small-box-footer">Consultar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow box-crud" data-ajax data-href="<?= Router::url(['controller' => 'hobbies']); ?>">
            <div class="inner">
              <h3><?= (int)$hobbies ?></h3>
              <p>Hobbies</p>
            </div>
            <div class="icon">
              <i class="fa fa-music"></i>
            </div>
            <a class="small-box-footer">Consultar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->