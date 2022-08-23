<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo route_to('dashboard.index') ?>">
        <div class="sidebar-brand-text mx-3">smaitabbskp.</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo route_to('dashboard.index') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Components
    </div>
    <!-- Nav Item - Cost -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Cost</span>
        </a>
        <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cost Components:</h6>
                <a class="collapse-item" href="<?php echo route_to('procurement.index') ?>">Procurement Cost</a>
                <a class="collapse-item" href="<?php echo route_to('startup.index') ?>">Start Up Cost</a>
                <a class="collapse-item" href="<?php echo route_to('projectrelated.index') ?>">Project Related Cost</a>
                <a class="collapse-item" href="<?php echo route_to('ongoing.index') ?>">Ongoing Cost</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Benefit -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Benefit</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Benefit Components:</h6>
                <a class="collapse-item" href="<?php echo route_to('tangible.index') ?>">Tangible Benefit</a>
                <a class="collapse-item" href="<?php echo route_to('intangible.index') ?>">Intangible Benefit</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Value
    </div>
    <!-- Nav Item - Tables Project Value -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo route_to('project_value.index') ?>">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Project Value</span></a>
    </li>
    <!-- Nav Item - Tables Cost Value -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo route_to('cost_value.index') ?>">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Cost Value</span></a>
    </li>
    <!-- Nav Item - Tables Benefit Value -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo route_to('benefit_value.index') ?>">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Benefit Value</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>
    <!-- Nav Item - Tables Users -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo route_to('user.index') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>User</span></a>
    </li>
    <!-- Nav Item - Tables Teachers -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo route_to('teacher.index') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Teacher</span></a>
    </li>
    <!-- Nav Item - Tables Students -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo route_to('student.index') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Student</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Calculator
    </div>
    <!-- Nav Item - Cost -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-calculator"></i>
            <span>Criteria</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Criteria Investment:</h6>
                <a class="collapse-item" href="<?php echo route_to('bcr.index') ?>">Benefit/ Cost Ratio</a>
                <a class="collapse-item" href="<?php echo route_to('npv.index') ?>">Net Present Value</a>
                <a class="collapse-item" href="<?php echo route_to('irr.index') ?>">Internal Rate of Return</a>
                <a class="collapse-item" href="<?php echo route_to('pp.index') ?>">Payback Period</a>
                <a class="collapse-item" href="<?php echo route_to('roi.index') ?>">Return on Investment</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>
    <!-- Nav Item - Tables Users -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo route_to('user.index') ?>">
            <i class="fas fa-fw fa-file"></i>
            <span>Report</span></a>
    </li>
</ul>