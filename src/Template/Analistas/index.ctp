<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Analistas
    <div class="pull-right"><?= $this->Html->link(__('<i class="fa fa-plus"></i> Novo'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs', 'escape' => false]) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header filtros">
          <h3 class="box-title"><?= __('Lista de') ?> Analistas</h3>
          <div class="box-tools pull-right">
              <?= $this->Form->create(null, [
                  'method' => 'GET',
                  'class' => 'form-inline',
                  'templates' => 'form_filtro',
                  'url' => ['controller' => 'analistas']
              ]); ?>
              <div class="form-group col-sm-1">
                  <?= $this->Form->input('id', ['label' => false, 'class' => 'form-control', 'placeholder' => 'ID', 'value' => $filtros['id']]); ?>
              </div>
              <div class="form-group col-sm-2">
              <?= $this->Form->input('Funcionarios.nome', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Nome', 'value' => $filtros['Funcionarios']['nome']]); ?>
              </div>
              <div class="form-group col-sm-1">
                  <?= $this->Form->input('Funcionarios.sexo', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Sexo', 'value' => $filtros['Funcionarios']['sexo']]); ?>
              </div>
              <div class="form-group col-sm-1">
                  <?= $this->Form->input('Funcionarios.idade', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Idade', 'value' => $filtros['Funcionarios']['idade']]); ?>
              </div>
              <div class="form-group col-sm-2">
                  <?= $this->Form->input('projeto', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Projeto', 'value' => $filtros['projeto']]); ?>
              </div>
              <button class="btn btn-info btn-flat" type="submit"><?= __('Filtrar') ?></button>
              <?= $this->Form->end(); ?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                  <th><?= $this->Paginator->sort('id') ?></th>
                  <th><?= $this->Paginator->sort('Funcionarios.nome', 'Nome') ?></th>
                  <th><?= $this->Paginator->sort('Funcionarios.sexo', 'Sexo') ?></th>
                  <th><?= $this->Paginator->sort('Funcionarios.idade', 'Idade') ?></th>
                <th><?= $this->Paginator->sort('projeto') ?></th>
                <th><?= __('Ações') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($analistas as $analista): ?>
              <tr>
                <td><?= $this->Number->format($analista->id) ?></td>
                  <td><?= $analista->has('funcionario') ? $analista->funcionario->nome : '' ?></td>
                  <td><?= $analista->has('funcionario') ? $analista->funcionario->sexo : '' ?></td>
                  <td><?= $analista->has('funcionario') ? $analista->funcionario->idade : '' ?></td>
                <td><?= h($analista->projeto) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $analista->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Editar'), ['action' => 'edit', $analista->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $analista->id], ['confirm' => __('Tem certeza que quer excluir este registro?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
