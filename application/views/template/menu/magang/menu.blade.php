<li class="nav-item">
    <a href="{{base_url('magang')}}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Home
        </p>
    </a>
</li>
<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{base_url('magang/izin')}}" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Permohonan Izin</p>
            </a>
        </li>
    </ul>
</li>
<li>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{base_url('assets/dist/img/logout.png')}}" class="img-circle elevation-2" alt="logout">
            </div>
            <div class="info">
                <a href="{{base_url()}}" class="d-block">Logout</a>
            </div>
        </div>
    </div>
</li>