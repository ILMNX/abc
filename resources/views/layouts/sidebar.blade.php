<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url(auth()->user()->foto ?? '') }}" class="img-circle img-profil" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
        <li class="header">DASHBOARD</li>
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-pie-chart"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="header">MENU ADVENTIST BOOK CENTER</li>
            
          <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>ADVENTIST BOOK CENTER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{ route('kategori_abc.index') }}"><i class="fa fa-pie-chart"></i> Kategori</a></li>
            <li><a href="{{ route('produk_abc.index') }}"><i class="fa fa-pie-chart"></i> Master Buku</a></li>
            <li><a href="{{ route('member_abc.index') }}"><i class="fa fa-pie-chart"></i> Pelanggan</a></li>
            <li><a href="{{ route('supplier_abc.index') }}"><i class="fa fa-pie-chart"></i> Supplier</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('pembelian_abc.index') }}"><i class="fa fa-pie-chart"></i> Penerimaan Dari IPH</a></li>
            <li><a href="{{ route('transaksi_abc.baru') }}"><i class="fa fa-pie-chart"></i> Transaksi Mutasi</a></li>
            <li><a href="{{ route('penjualan_abc.index') }}"><i class="fa fa-pie-chart"></i> Data Mutasi Buku</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-pie-chart"></i> Laporan Inventory</a></li>
            
          </ul>
        </li>
            
          </ul>
        </li>
            
            @if (auth()->user()->level == 1)
            <li class="header">DATA GUDANG DAN TRANSAKSI PENJUAL</li>
            <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>DATA PENJUAL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{ route('kategori.index') }}"><i class="fa fa-pie-chart"></i> Kategori</a></li>
            <li><a href="{{ route('produk.index') }}"><i class="fa fa-pie-chart"></i> Master Buku</a></li>
            <li><a href="{{ route('member.index') }}"><i class="fa fa-pie-chart"></i> Pelanggan</a></li>
            <li><a href="{{ route('supplier.index') }}"><i class="fa fa-pie-chart"></i> Supplier</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('pembelian.index') }}"><i class="fa fa-pie-chart"></i> Penerimaan Dari ABC</a></li>
            <li><a href="{{ route('transaksi.baru') }}"><i class="fa fa-pie-chart"></i> Transaksi Penjualan</a></li>
            <li><a href="{{ route('penjualan.index') }}"><i class="fa fa-pie-chart"></i> Data Penjualan Buku</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{ route('laporan.index') }}"><i class="fa fa-pie-chart"></i> Laporan Inventory</a></li>
            
          </ul>
        </li>
            
          </ul>
        </li>
            
            <li class="header">PENGATURAN SYSTEM</li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-users"></i> <span>User</span>
                </a>
            </li>
            <li>
                <a href="{{ route('setting.index') }}">
                    <i class="fa fa-cogs"></i> <span>Pengaturan</span>
                </a>
            </li>
            @else
            <li>
                <a href="{{ route('transaksi.index') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Aktif</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.baru') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Baru</span>
                </a>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>