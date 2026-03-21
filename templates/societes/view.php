<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Societe $societe
 */
?>

<div class="user-view-box">
    <h2 class="view-title">Company Information</h2>

    <div class="societe-info">
        <p><strong>Name:</strong> <?= h($societe->nom) ?></p>
        <p><strong>Address:</strong> <?= h($societe->adresse) ?></p>
        <p><strong>Phone:</strong> <?= h($societe->telephone) ?></p>
        <p><strong>Fax:</strong> <?= h($societe->fax) ?></p>
        <p><strong>Email:</strong> <?= h($societe->email) ?></p>
        <p><strong>Detailed Address:</strong> <?= h($societe->adress) ?></p>

    </div>

    <div class="view-actions">
        <?= $this->Html->link('Back', ['action' => 'societestable'], ['class' => 'btn-back']) ?>
    </div>
</div>
