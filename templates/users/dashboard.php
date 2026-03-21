<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var array $stats
 */
?>

<div class="dashboard-wrapper" style="padding: 20px;">
    
    <div class="welcome-banner" style="background: linear-gradient(135deg, #60cff7 0%, #3bb8e7 100%); color: white; padding: 30px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 4px 12px rgba(96,207,247,0.3);">
        <h1 style="margin: 0; font-size: 28px; font-weight: 600;">Welcome back, <?= h($user->name) ?>! 👋</h1>
        <p style="margin: 10px 0 0 0; font-size: 16px; opacity: 0.9;">Here is what's happening in your application today.</p>
    </div>

    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
        
        <!-- Chalets Stat -->
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 12px; border-left: 5px solid #f26d9e; box-shadow: 0 2px 8px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 13px; font-weight: 700; color: #f26d9e; text-transform: uppercase; margin-bottom: 5px;">Total Chalets</div>
                <div style="font-size: 28px; font-weight: 700; color: #333;"><?= $stats['chalets_count'] ?></div>
            </div>
            <div style="font-size: 32px; color: #fce4ec;">
                <i class="fas fa-newspaper" style="color: #f26d9e;"></i>
            </div>
        </div>

        <!-- Reservations Stat -->
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 12px; border-left: 5px solid #60cff7; box-shadow: 0 2px 8px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 13px; font-weight: 700; color: #60cff7; text-transform: uppercase; margin-bottom: 5px;">Total Reservations</div>
                <div style="font-size: 28px; font-weight: 700; color: #333;"><?= $stats['reservations_count'] ?></div>
            </div>
            <div style="font-size: 32px; color: #e1f5fe;">
                <i class="fas fa-calendar-check" style="color: #60cff7;"></i>
            </div>
        </div>

        <!-- Clients Stat -->
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 12px; border-left: 5px solid #4CAF50; box-shadow: 0 2px 8px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 13px; font-weight: 700; color: #4CAF50; text-transform: uppercase; margin-bottom: 5px;">Registered Clients</div>
                <div style="font-size: 28px; font-weight: 700; color: #333;"><?= $stats['clients_count'] ?></div>
            </div>
            <div style="font-size: 32px; color: #e8f5e9;">
                <i class="fas fa-users" style="color: #4CAF50;"></i>
            </div>
        </div>

        <!-- Users Stat -->
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 12px; border-left: 5px solid #ffc107; box-shadow: 0 2px 8px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 13px; font-weight: 700; color: #ffc107; text-transform: uppercase; margin-bottom: 5px;">System Admins</div>
                <div style="font-size: 28px; font-weight: 700; color: #333;"><?= $stats['users_count'] ?></div>
            </div>
            <div style="font-size: 32px; color: #fff8e1;">
                <i class="fas fa-user-shield" style="color: #ffc107;"></i>
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <h3 style="color: #00070e; margin-bottom: 20px; font-weight: 600;">Quick Actions</h3>
    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
        <?= $this->Html->link('<i class="fas fa-calendar-plus" style="margin-right: 8px;"></i> New Reservation', ['controller' => 'Reservations', 'action' => 'add'], ['class' => 'btn-view', 'style' => 'padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; transition: 0.2s;', 'escape' => false]) ?>
        
        <?= $this->Html->link('<i class="fas fa-user-plus" style="margin-right: 8px;"></i> New Client', ['controller' => 'Clients', 'action' => 'add'], ['class' => 'btn-back', 'style' => 'padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; transition: 0.2s;', 'escape' => false]) ?>
        
        <?= $this->Html->link('<i class="fas fa-home" style="margin-right: 8px;"></i> Add Chalet', ['controller' => 'Chalets', 'action' => 'add'], ['class' => 'btn-add-user', 'style' => 'background-color: #f26d9e; color: white; border: none; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; transition: 0.2s;', 'escape' => false]) ?>

        <?= $this->Html->link('<i class="fas fa-dollar-sign" style="margin-right: 8px;"></i> New Tariff', ['controller' => 'tarifs', 'action' => 'add'], ['class' => 'btn-edit', 'style' => 'padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; transition: 0.2s; background-color: #ffc107; color: white; border: none;', 'escape' => false]) ?>

        <?= $this->Html->link('<i class="fas fa-money-check-alt" style="margin-right: 8px;"></i> Receive Payment', ['controller' => 'Reglements', 'action' => 'add'], ['class' => 'btn-delete', 'style' => 'background-color: #17a2b8; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; transition: 0.2s; color: white; border: none;', 'escape' => false]) ?>
        
        <?= $this->Html->link('<i class="fas fa-user-shield" style="margin-right: 8px;"></i> Add Admin', ['controller' => 'Users', 'action' => 'add'], ['class' => 'btn-delete', 'style' => 'background-color: #6c757d; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; transition: 0.2s; color: white; border: none;', 'escape' => false]) ?>
    </div>
</div>

<style>
.stat-card:hover {
    transform: translateY(-3px);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    box-shadow: 0 8px 15px rgba(0,0,0,0.1) !important;
}
.btn-add-user:hover, .btn-view:hover, .btn-back:hover {
    filter: brightness(0.9);
    transform: translateY(-2px);
}
</style>
