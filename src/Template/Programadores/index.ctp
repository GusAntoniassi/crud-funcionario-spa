<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Programadores
    <div class="pull-right"><?= $this->Html->link(__('<i class="fa fa-plus"></i> Novo'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs', 'escape' => false]) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header filtros">
          <h3 class="box-title"><?= __('Lista de') ?> Programadores</h3>
          <div class="box-tools">
              <?= $this->Form->create(null, [
                  'method' => 'GET',
                  'class' => 'form-inline',
                  'templates' => 'form_filtro',
                  'url' => ['controller' => 'programadores']
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
                  <?= $this->Form->input('linguagem', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Linguagem', 'value' => $filtros['linguagem']]); ?>
              </div>
              <div class="form-group col-sm-2">
                  <?= $this->Form->input('github', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Github', 'value' => $filtros['github']]); ?>
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
                <th><?= $this->Paginator->sort('linguagem') ?></th>
                <th><?= $this->Paginator->sort('github') ?></th>
                <th><?= __('Ações') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($programadores as $programador): ?>
              <tr>
                <td><?= $this->Number->format($programador->id) ?></td>
                <td><?= $programador->has('funcionario') ? $programador->funcionario->nome : '' ?></td>
                <td><?= $programador->has('funcionario') ? $programador->funcionario->sexo : '' ?></td>
                <td><?= $programador->has('funcionario') ? $programador->funcionario->idade : '' ?></td>
                <td><?= h($programador->linguagem) ?></td>
                <td><?= h(!empty($programador->github) ? $programador->github : '') ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $programador->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Editar'), ['action' => 'edit', $programador->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $programador->id], ['confirm' => __('Tem certeza que quer excluir este registro?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
