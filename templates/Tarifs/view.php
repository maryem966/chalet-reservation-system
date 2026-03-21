<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarif $tarif
 */
?>

<div class="user-view-box">
    <h2 class="view-title">Tariff Information</h2>

    <div class="tarif-info">
        <p><strong>Chalet:</strong> 
            <?= $tarif->has('chalet') ? h($tarif->chalet->nom_chalet) : '—' ?>
        </p>
        <p><strong>Price:</strong> <?= h($tarif->prix) ?></p>
        <p><strong>Start Date:</strong> <?= h($tarif->date_debut) ?></p>
        <p><strong>End Date:</strong> <?= h($tarif->date_fin) ?></p>
    </div>

    <div class="view-actions">
        <?= $this->Html->link('Back', ['action' => 'tarifstable'], ['class' => 'btn-back']) ?>
    </div>
</div>
