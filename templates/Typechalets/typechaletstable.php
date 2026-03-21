<div id="typechalet-management-section" class="user-table-section">
    <div class="top-bar">
        <h3 class="text-primary mb-0"><?= __('Chalet Types Management') ?></h3>
        <?= $this->Html->link(__('+ New Type'), ['action' => 'add'], ['class' => 'btn-add-user']) ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th><?= $this->Paginator->sort('name', ' Type') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($typechalets as $typechalet): ?>
                <tr>
                    <td><?= h($typechalet->name) ?></td>

                    <td class="text-center">
                        <?= $this->Html->link(
                            '<i class="fas fa-eye"></i> View',
                            ['action' => 'view', $typechalet->id],
                            ['class' => 'btn-action btn-view', 'escape' => false]
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fas fa-edit"></i> Edit',
                            ['action' => 'edit', $typechalet->id],
                            ['class' => 'btn-action btn-edit', 'escape' => false]
                        ) ?>

                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash-alt"></i> Delete',
                            ['action' => 'delete', $typechalet->id],
                            [
                                'class' => 'btn-action btn-delete',
                                'confirm' => 'Are you sure you want to delete?',
                                'escape' => false
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
