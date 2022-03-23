<?php
$role = $this->session->userdata('role');
?>
<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Transaksi
</div>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaction" aria-expanded="true" aria-controls="transaction">
        <i class="fas fa-money-bill-wave"></i>
        <span>Data Transaksi</span>
    </a>
    <div id="transaction" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Input:</h6>
            <a class="collapse-item" href="<?= base_url('Admin/depositTransactionList') ?>">Deposit</a>
        </div>
    </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Master Data
</div>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-database" aria-hidden="true"></i>
        <span>Master Data</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Input:</h6>
            <a class="collapse-item" href="<?= base_url('Admin/customerList') ?>">Palanggan</a>
        </div>
    </div>
</li>
<?php if ($role == '1') { ?>
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Data Setting
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datavalue" aria-expanded="true" aria-controls="datavalue">
            <i class="fas fa-cog"></i><i class="fa fa-database" aria-hidden="true"></i>
            <span>Setting Data</span>
        </a>
        <d`i`v id="datavalue" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Input:</h6>
                <a class="collapse-item" href="<?= base_url('Admin/depositList') ?>">Jenis Deposit</a>
            </div>
            </d>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#galery" aria-expanded="true" aria-controls="galery">
            <i class="fas fa-users"></i>
            <span>User</span>
        </a>
        <div id="galery" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Input:</h6>
                <a class="collapse-item" href="<?= base_url('Admin/userList') ?>">User</a>
            </div>
        </div>
    </li>
<?php } ?>