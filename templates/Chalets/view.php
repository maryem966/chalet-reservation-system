<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chalet $chalet
 */
?>

<div class="user-view-box">
    <h2 class="view-title">Chalet Information</h2>

    <div class="user-info">
        <p><strong>ID:</strong> <?= h($chalet->id_chalet) ?></p>
        <p><strong>Chalet Code:</strong> <?= h($chalet->code) ?></p> <!-- Champ ajouté -->
        <p><strong>Chalet Name:</strong> <?= h($chalet->nom_chalet) ?></p>
        <p><strong>Type:</strong> <?= h($chalet->typechalet_id) ?></p>
        <p><strong>Capacity:</strong> <?= h($chalet->capacite) ?> Persons</p>
        <p><strong>Price لكل ليلة:</strong> <?= h($chalet->prix_par_nuit) ?> د.م</p>
        <p><strong>Status:</strong>
            <?php
                switch ($chalet->statut) {
                    case 'Disponible':
                        echo 'Available';
                        break;
                    case 'Réservé':
                        echo 'Reserved';
                        break;
                    case 'Maintenance':
                        echo 'Under Maintenance';
                        break;
                    default:
                        echo '-';
                }
            ?>
        </p>
        <p><strong>Description:</strong> <?= h($chalet->description) ?></p>
        <p><strong>Image:</strong><br>
            <?php if (!empty($chalet->photo)): ?>
                <img src="/img/chalets/<?= h($chalet->photo) ?>" alt="Chalet Image" width="200" height="150" style="object-fit: cover; border-radius: 10px;">
            <?php else: ?>
                <span>No image available</span>
            <?php endif; ?>
        </p>
        
    </div>

    <div class="view-actions">
        <?= $this->Html->link('Back', ['action' => 'chaletstable'], ['class' => 'btn-back']) ?>
    </div>
</div>
