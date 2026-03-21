<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Modespaiement $modespaiement
 */
?>

<div class="user-view-box">
    <h2 class="view-title">معلومات Payment Method</h2>

    <div class="user-info">
        <p><strong>Payment Type:</strong> <?= h($modespaiement->nom) ?></p>

    </div>

    <div class="view-actions">
        <?= $this->Html->link('Back', ['action' => 'modestable'], ['class' => 'btn-back']) ?>
    </div>
</div>
