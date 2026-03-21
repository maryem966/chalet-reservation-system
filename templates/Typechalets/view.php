<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typechalet $typechalet
 */
?>

<div class="user-view-box">
    <h2 class="view-title">Chalet Type Information</h2>

    <div class="typechalet-info">
        <p><strong>ID:</strong> <?= $this->Number->format($typechalet->id) ?></p>
        <p><strong>Name:</strong> <?= h($typechalet->name) ?></p>
    </div>

    <div class="view-actions">
        <?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>
