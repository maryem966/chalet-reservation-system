<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>

<div class="user-view-box">
    <h2 class="view-title">Client Information</h2>

    <div class="user-info">
        <p><strong>Full Name:</strong> <?= h($client->name) ?></p>
        <p><strong>Date of Birth:</strong> <?= h($client->birth_date) ?></p>
        <p><strong>Email:</strong> <?= h($client->email) ?></p>
        <p><strong>WhatsApp Number:</strong> <?= h($client->whatsapp) ?></p>
        <p><strong>Phone Number:</strong> <?= h($client->phone) ?></p>
        <p><strong>Passport Number:</strong> <?= h($client->passport_number) ?></p>
        <p><strong>Nationality:</strong> <?= h($client->nationality) ?></p>
       
    </div>

    <div class="view-actions">
        <?= $this->Html->link('Back', ['action' => 'clientstable'], ['class' => 'btn-back']) ?>
    </div>
</div>
