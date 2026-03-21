<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="user-view-box">
    <h2 class="view-title">User Information</h2>

    <div class="user-info">
        <p><strong>Name:</strong> <?= h($user->name) ?></p>
        <p><strong>Email:</strong> <?= h($user->email) ?></p>
        <p><strong>تاريخ الAdd:</strong> <?= h($user->created) ?></p>
        <p><strong>Last Modified:</strong> <?= h($user->modified) ?></p>
    </div>

    <div class="view-actions">
        <?= $this->Html->link('Back', ['action' => 'table'], ['class' => 'btn-back']) ?>
    </div>
</div>
