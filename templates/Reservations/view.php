<style>
    .box-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .user-view-box {
        flex: 1;
        min-width: 45%;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .view-title {
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: bold;
        color: #333;
        text-align: right;
    }

    .user-info p {
        margin: 5px 0;
        text-align: right;
    }

    .view-actions {
        margin-top: 30px;
        text-align: center;
    }

    .btn-back {
        background-color: #4CAF50;
        color: white;
        padding: 10px 30px;
        text-decoration: none;
        font-size: 15px;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        display: inline-block;
        border: none;
    }

    .btn-back:hover {
        background-color: #45a049;
    }
</style>

<!-- ✅ Row 1 : Client Info -->
<div class="box-row">
    <div class="user-view-box">
        <h2 class="view-title">Client Information</h2>
        <div class="user-info">
            <p><strong>Name:</strong> <?= h($reservation->client->name ?? 'N/A') ?></p>
            <p><strong>Date of Birth:</strong> <?= h($reservation->client->birth_date ?? 'N/A') ?></p>
            <p><strong>Passport Number:</strong> <?= h($reservation->client->passport_number ?? 'N/A') ?></p>
            <p><strong>Nationality:</strong> <?= h($reservation->client->nationality ?? 'N/A') ?></p>
            <p><strong>Phone:</strong> <?= h($reservation->client->phone ?? 'N/A') ?></p>
            <p><strong>WhatsApp:</strong> <?= h($reservation->client->whatsapp ?? 'N/A') ?></p>
            <p><strong>Email:</strong> <?= h($reservation->client->email ?? 'N/A') ?></p>
        </div>
    </div>

    <div class="user-view-box">
        <h2 class="view-title">Reservation Details</h2>
        <div class="user-info">
            <p><strong>Reservation Date:</strong> <?= h($reservation->date_reservation) ?></p>
            <p><strong>Number of Chalets Reserved:</strong> <?= count($reservation->reservationsdetails) ?></p>

        </div>
    </div>
</div>

<!-- ✅ Loop over ReservationDetails -->
<?php foreach ($reservation->reservationsdetails as $reservationDetail): ?>
    <div class="box-row">
        <!-- Chalet Info -->
        <div class="user-view-box">
            <h2 class="view-title">Chalet Information</h2>
            <div class="user-info">
                <p><strong>رقم Chalet:</strong> <?= h($reservationDetail->chalet->id_chalet ?? 'N/A') ?></p>
                <p><strong>Chalet Name:</strong> <?= h($reservationDetail->chalet->nom_chalet ?? 'N/A') ?></p>
                <p><strong>Capacity:</strong> <?= h($reservationDetail->chalet->capacite ?? 'N/A') ?> Persons</p>
                <p><strong>Price لكل ليلة:</strong> <?= h($reservationDetail->chalet->prix_par_nuit ?? 'N/A') ?> د.ت</p>
            </div>
        </div>

        <!-- Tariff Info -->
        <div class="user-view-box">
            <h2 class="view-title">Applied Tariff</h2>
            <div class="user-info">
                <?php if (!empty($reservationDetail->tarif)) : ?>
                    <p><strong>Tariff Name:</strong> <?= h($reservationDetail->tarif->label) ?></p>
                    <p><strong>Price:</strong> <?= h($reservationDetail->tarif->price) ?> د.ت</p>
                <?php else : ?>
                    <p>No linked tariff</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="box-row">
        <!-- Duration -->
        <div class="user-view-box">
            <h2 class="view-title">Reservation Duration</h2>
            <div class="user-info">
                <p><strong>From:</strong> <?= h($reservationDetail->date_debut) ?></p>
                <p><strong>To:</strong> <?= h($reservationDetail->date_fin) ?></p>
            </div>
        </div>

        <!-- Payment Info -->
        <div class="user-view-box">
            <h2 class="view-title">Payment Information</h2>
            <div class="user-info">
                <p><strong>Total Amount:</strong> <?= h($reservationDetail->prix) ?> د.ت</p>
            </div>
        </div>
    </div>

    <div class="box-row">
        <!-- Metadata -->
        <div class="user-view-box">
            <h2 class="view-title">Logs</h2>
            <div class="user-info">
                <p><strong>Added At:</strong> <?= h($reservationDetail->created) ?></p>
                <p><strong>Last Modified:</strong> <?= h($reservationDetail->modified) ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- ✅ Back Button -->
<div class="view-actions">
    <?= $this->Html->link('Back', ['action' => 'reservationstable'], ['class' => 'btn-back']) ?>
</div>
