<nav style="background-color: #2d2c38;" class="navbar align-items-start sidebar sidebar-dark accordion p-0 navbar-dark">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0 py-5" href="#">
            <div class="sidebar-brand-icon">
                <i class="fab fa-wikipedia-w"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><span>Wiki™</span></div>
        </a>
        <ul class="navbar-nav text-light" id="accordionSidebar">
            <?php if ($_SESSION['role'] == 'admin') { ?>
            <li class="nav-item"><a class="nav-link active" href="/dashboard"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="/wikis/display"><i class="fab fa-wikipedia-w"></i><span>Gestion des wikis</span></a></li>
            <li class="nav-item"><a class="nav-link" href="/wikis/archived"><i class="fas fa-inbox"></i><span>Les wikis archivés</span></a></li>
            <li class="nav-item"><a class="nav-link" href="/categories"><i class="far fa-folder"></i><span>Gestion des catégories</span></a></li>
            <li class="nav-item"><a class="nav-link" href="/tags"><i class="fas fa-tags"></i><span>Gestion des tags</span></a></li>
            <?php } else { ?>
            <li class="nav-item"><a class="nav-link active" href="/dashboard"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="/wikis"><i class="fab fa-wikipedia-w"></i><span>Mes wikis</span></a></li>
            <?php } ?>
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>