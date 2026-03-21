<div id="client-management-section" class="user-table-section">
    <div class="top-bar">
        <h3 class="text-primary mb-0"><?= __('Client Management') ?></h3>
        <?= $this->Html->link(__('+ New Client'), ['action' => 'add'], ['class' => 'btn-add-user']) ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th><?= $this->Paginator->sort('name', 'Name') ?></th>
                    <th><?= $this->Paginator->sort('birth_date', 'Date of Birth') ?></th>
                    <th><?= $this->Paginator->sort('email', 'Email') ?></th>
                    <th><?= $this->Paginator->sort('whatsapp', 'WhatsApp') ?></th>
                    <th><?= $this->Paginator->sort('phone', 'Phone') ?></th>
                    <th><?= $this->Paginator->sort('passport_number', 'Passport Number') ?></th>
                    <th><?= $this->Paginator->sort('nationality', 'Nationality') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= h($client->name) ?></td>
                    <td><?= h($client->birth_date) ?></td>
                    <td><?= h($client->email) ?></td>
                    <td><?= h($client->whatsapp) ?></td>
                    <td><?= h($client->phone) ?></td>
                    <td><?= h($client->passport_number) ?></td>
                    <td><?= h($client->nationality) ?></td>
                    <td class="text-center">
                        <?= $this->Html->link(
                            '<i class="fas fa-eye"></i> View',
                            ['action' => 'view', $client->id],
                            ['class' => 'btn-action btn-view', 'escape' => false]
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fas fa-edit"></i> Edit',
                            ['action' => 'edit', $client->id],
                            ['class' => 'btn-action btn-edit', 'escape' => false]
                        ) ?>

                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash-alt"></i> Delete',
                            ['action' => 'delete', $client->id],
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
