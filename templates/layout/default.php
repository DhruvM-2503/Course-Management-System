<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->Html->css('custom') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 shadow-sm">
    <div class="container-fluid">
        <?php if ($this->Identity->get('role') === 'user'): ?>
        <a class="navbar-brand courses-def" href="<?= $this->Url->build(['controller' => 'Courses', 'action' => 'myCourses']) ?>">
            <i class="fa-solid fa-graduation-cap me-1"></i>MyCourses
        </a>
        <?php endif; ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($this->Identity->isLoggedIn()): ?>
                    <li class="nav-item">
                        <?= $this->Html->link('<i class="fa fa-book-open"></i> Explore Courses', 
                            ['controller' => 'Courses', 'action' => 'index'], 
                            ['class' => 'nav-link mt-3', 'escape' => false]
                        ) ?>
                    </li>
                    <?php if ($this->Identity->get('role') === 'admin'): ?>
                        <?= $this->Html->link('<i class="fa-solid fa-user"></i> Admin Dashboard', 
                            ['controller' => 'Courses', 'action' => 'adminDashboard'], 
                            ['class' => 'nav-link mt-3', 'escape' => false]
                        ) ?>
                        <?= $this->Html->link('<i class="fa-solid fa-square-poll-vertical"></i> Leaderboards', 
                            ['controller' => 'Leaderboards', 'action' => 'index'], 
                            ['class' => 'nav-link mt-3', 'escape' => false]
                        ) ?>
                        <?= $this->Html->link('<i class="fa-solid fa-bell"></i> Notify Users', 
                            ['controller' => 'Notifications', 'action' => 'add'], 
                            ['class' => 'nav-link mt-3', 'escape' => false]
                        ) ?>
                    <?php else: ?>

                    <li class="nav-item">
                    <?= $this->Html->link('<i class="fa fa-chart-line"></i> My Dashboard', 
                        ['controller' => 'Courses', 'action' => 'userDashboard'], 
                        ['class' => 'nav-link mt-3', 'escape' => false]
                    ) ?>
                    </li>
                    <li class="nav-item">
                    <?= $this->Html->link('<i class="fa-solid fa-square-poll-vertical"></i> Leaderboards', 
                        ['controller' => 'Leaderboards', 'action' => 'index'], 
                        ['class' => 'nav-link mt-3', 'escape' => false]
                    ) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link(
                            '<i class="fa-solid fa-bell"></i> Notifications' .
                            (!empty($unreadNotificationCount) ? ' <sup class="badge bg-danger">' . $unreadNotificationCount . '</sup>' : ''),
                            ['controller' => 'Notifications', 'action' => 'userNotifications'],
                            ['class' => 'nav-link mt-3', 'escape' => false]
                        ) ?>
                    </li>
                    </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if ($this->Identity->isLoggedIn()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mt-2" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fa fa-user-circle"></i> <?= h($this->Identity->get('username')) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <?= $this->Html->link('<i class="fa fa-id-badge"></i> Profile', 
                                    ['controller' => 'Users', 'action' => 'view', $this->Identity->get('id')], 
                                    ['class' => 'dropdown-item drop', 'escape' => false]
                                ) ?>
                            </li>
                            <li>
                                <?= $this->Html->link('<i class="fa fa-right-from-bracket"></i> Logout', 
                                    ['controller' => 'Users', 'action' => 'logout'], 
                                    ['class' => 'dropdown-item drop', 'escape' => false]
                                ) ?>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <?= $this->Html->link('<i class="fa fa-sign-in-alt"></i> Login', 
                            ['controller' => 'Users', 'action' => 'login'], 
                            ['class' => 'nav-link', 'escape' => false]
                        ) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('<i class="fa fa-user-plus"></i> Register', 
                            ['controller' => 'Users', 'action' => 'add'], 
                            ['class' => 'nav-link', 'escape' => false]
                        ) ?>
                    </li>
                    
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js') ?>
</body>
</html>
