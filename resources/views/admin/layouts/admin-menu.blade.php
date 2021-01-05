
		<div class="sidebar-menu">
			<!-- BEGIN SIDEBAR MENU ITEMS-->
			<ul class="menu-items">
            @if(auth()->user()->hasRole('admin'))
			<li class="mt-4">
				<a href="{{url('administrator')}}">
				<span class="title">Dashboard</span>
				</a>
				<span class="icon-thumbnail"><i class="pg-home"></i></span>
			</li>
			<li class="">
				<a href="javascript:;">
				<span class="title">Barang</span><span class=" arrow"></span>
				</a>
				<span class="icon-thumbnail"><i class="pg-bag"></i></span>
				<ul class="sub-menu">
				      <li class="">
				        <a href="{{url('administrator/barang/kategori')}}">Kategori</a>
				        <span class="icon-thumbnail">K</span>
				      </li>
				      <li class="">
				        <a href="{{url('administrator/barang')}}">Data Barang</a>
				        <span class="icon-thumbnail">B</span>
				      </li>
				</ul>
			</li>
			<li class="">
				<a href="javascript:;">
				<span class="title">Peminjaman</span><span class=" arrow"></span>
				</a>
				<span class="icon-thumbnail"><i class="pg-tables"></i></span>
				<ul class="sub-menu">
				      <li class="">
				        <a href="{{url('administrator/peminjaman')}}">Ajuan Peminjaman</a>
				        <span class="icon-thumbnail"><i class="pg-calender"></i></span>
				      </li>
				      <li class="">
				        <a href="{{url('administrator/peminjaman/riwayat')}}">Riwayat Peminjaman</a>
				        <span class="icon-thumbnail"><i class="pg-clock"></i></span>
				      </li>
				</ul>
			</li>
			<li class="">
				<a href="javascript:;">
				<span class="title">Laporan</span><span class=" arrow"></span>
				</a>
				<span class="icon-thumbnail"><i class="pg-printer"></i></span>
				<ul class="sub-menu">
				      <li class="">
				        <a href="{{url('administrator/peminjaman')}}">Peminjaman</a>
				        <span class="icon-thumbnail"><i class="pg-calender"></i></span>
				      </li>
				</ul>
            </li>
			<li class="">
				<a href="javascript:;">
				<span class="title">User</span><span class=" arrow"></span>
				</a>
				<span class="icon-thumbnail"><i class="pg-laptop"></i></span>
				<ul class="sub-menu">
				      <li class="">
				        <a href="{{url('administrator/lembaga')}}">Lembaga</a>
				        <span class="icon-thumbnail"><i class="pg-suitcase"></i></span>
				      </li>
				      <li class="">
				        <a href="{{url('administrator/user')}}">Data User</a>
				        <span class="icon-thumbnail"><i class="pg-lock"></i></span>
				      </li>
				</ul>
            </li>
            @endif
            @if(auth()->user()->hasRole('user'))
			<li class="mt-4">
				<a href="{{url('administrator')}}">
				<span class="title">Dashboard</span>
				</a>
				<span class="icon-thumbnail"><i class="pg-home"></i></span>
			</li>
			<li class="">
				<a href="javascript:;">
				<span class="title">Peminjaman</span><span class=" arrow"></span>
				</a>
				<span class="icon-thumbnail"><i class="pg-tables"></i></span>
				<ul class="sub-menu">
                    <li class="">
                    <a href="{{url('peminjaman')}}">Inventaris</a>
                    <span class="icon-thumbnail"><i class="pg-theme"></i></span>
                    </li>
                    @foreach (MainHelp::getBarang() as $barang)
				      <li class="">
				        <a href="{{url('peminjaman')}}">{{$barang->nama_barang}}</a>
				        <span class="icon-thumbnail"><i class="pg-theme"></i></span>
				      </li>
                    @endforeach
				</ul>
			</li>
			<li class="">
				<a href="{{url('administrator')}}">
				<span class="title">Histori Peminjaman</span>
				</a>
				<span class="icon-thumbnail"><i class="pg-clock"></i></span>
            </li>
            @endif
		</ul>
		<div class="clearfix"></div>
	</div>
