<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?></title>

    <!-- Lien vers ton CSS -->
    <?= $this->Html->css('dashboard') ?>
    <?= $this->Html->css('user-table') ?>
    <?= $this->Html->css('user-form') ?>
    <?= $this->Html->css('view') ?>

    <!-- Font Awesome pour les icônes -->
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js') ?>
</head>
<body>

<?php
// Read user info from session that was set during login
$session = $this->request->getSession();
$user = $session->read('User');
$userName = $user ? $user->name : 'User';
?>

<!-- BARRE DU HAUT -->
<header class="navbar">
    <div class="navbar-left">
        <i class="fas fa-bars"></i>
    </div>
    <div class="navbar-right">
            
        <i class="fas fa-sign-out-alt"></i>
        <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['style' => 'color: inherit; text-decoration: none;']) ?>
    </div>
</header>

<div class="main-container">
    <!-- SIDEBAR DROITE -->
    <aside class="sidebar">
        <div class="admin-box">
            <div class="logo"><i class="fas fa-user-cog"></i></div>
            <div class="admin-name">Welcome <?= h($userName) ?></div>
        </div>
        <ul class="sidebar-menu">
            <li>
                <i class="fas fa-home"></i>
                <?= $this->Html->link('Dashboard', ['controller' => 'Users', 'action' => 'dashboard'], ['style' => 'color: inherit; text-decoration: none;']) ?>
            </li>

            <li>
                <i class="fas fa-users"></i>
                <?= $this->Html->link('User Management', ['controller' => 'Users', 'action' => 'table'], ['style' => 'color: inherit; text-decoration: none;']) ?>
            </li>
            <li>
                <i class="fas fa-user-friends"></i>
                <?= $this->Html->link('Clients', ['controller' => 'Clients', 'action' => 'clientstable'], ['style' => 'color: inherit; text-decoration: none;']) ?>
            </li>
            <li>
                <i class="fas fa-newspaper"></i>
                <?= $this->Html->link('Chalets', ['controller' => 'Chalets', 'action' => 'chaletstable'], ['style' => 'color: inherit; text-decoration: none;']) ?>
            </li>

            <li>
                <i class="fas fa-calendar"></i>
                <?= $this->Html->link('Reservations', ['controller' => 'reservations', 'action' => 'reservationstable'], ['style' => 'color: inherit; text-decoration: none;']) ?>
            </li>
            <li>
                <i class="fas fa-dollar-sign"></i>
                <?= $this->Html->link('Tariffs', ['controller' => 'tarifs', 'action' => 'tarifstable'], ['style' => 'color: inherit; text-decoration: none;']) ?>
            </li>
            <li>
            <i class="fas fa-money-check-alt"></i>
            <?= $this->Html->link('Payment', ['controller' => 'Reglements', 'action' => 'reglementstable'], ['style' => 'color: inherit; text-decoration: none;']) ?>
            </li>




            <li class="dropdown">
                <div class="dropdown-toggle" onclick="toggleDropdown()" style="cursor: pointer; display: flex; align-items: center; justify-content: space-between;">
                    <div><i class="fas fa-cog"></i> Settings</div> <i class="fas fa-chevron-down"></i>
                </div>
                <ul class="dropdown-menu" id="settings-dropdown" style="display: none;">
                    <li>
                        <i class="fas fa-building"></i>
                        <?= $this->Html->link('Company', ['controller' => 'Societes', 'action' => 'societestable'], ['style' => 'color: inherit; text-decoration: none;']) ?>
                    </li>
                    <li>
                        <i class="fas fa-warehouse"></i>
                        <?= $this->Html->link('Chalet Types', ['controller' => 'Typechalets', 'action' => 'typechaletstable'], ['style' => 'color: inherit; text-decoration: none;']) ?>
                    </li>
                    <li>
                        <i class="fas fa-credit-card"></i>
                        <?= $this->Html->link('Payment Method', ['controller' => 'Modespaiements', 'action' => 'modestable'], ['style' => 'color: inherit; text-decoration: none;']) ?>
                    </li>
                </ul>
            </li>

        </ul>
    </aside>

    <main class="dashboard-content">
        <?= $this->fetch('content') ?>
    </main>
</div>

<script>
    function scrollToUserSection() {
        const section = document.getElementById('user-management-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
    function scrollToClientSection() {
        const section = document.getElementById('client-management-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
    function scrollToChaletSection() {
        const section = document.getElementById('chalets-management-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
    function scrollToSocieteSection() {
        const section = document.getElementById('societes-management-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
    function scrollToTarifSection() {
        const section = document.getElementById('tarifs-management-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
    function scrollToReservationSection() {
        const section = document.getElementById('reservations-management-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }




    function toggleDropdown() {
    const dropdown = document.getElementById('settings-dropdown');
    if (dropdown.style.display === 'none' || dropdown.style.display === '') {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
}

</script>


<style> 

.sidebar-menu .dropdown-menu {
    list-style: none;       /* Remove bullets */
    padding: 0;             /* Remove default padding */
    margin: 0;              /* Remove default margin */
}

.sidebar-menu .dropdown-menu li {
    padding: 8px 12px 8px 30px; /* Indented neatly under text */
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 2px; /* Less vertical space */
    border-radius: 5px;
}
</style>

</body>
</html>