  <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/DSC00027.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Senthil</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">            
            <li class="active treeview" id="Dashboard">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="index.php"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.php"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Orders</span>
               <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Order Entry</a></li>
                <li><a href="javascript:void(0)" onclick="getcontentwrapper('pages/order/allorders.php')"><i class="fa fa-circle-o"></i> All Orders</a></li>
                <li><a href="javascript:void(0)" href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Production</a></li>
                <li><a href="javascript:void(0)" href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Shipment</a></li>
                <li><a href="javascript:void(0)" href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Archives</a></li>                
              </ul>
            </li>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Customers</span>
               <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="javascript:void(0)" href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> View Customers</a></li>
                <li><a href="javascript:void(0)" href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Add Customer</a></li>                
                <li><a href="javascript:void(0)" href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Archived Customers</a></li>                
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Reports</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>            
            
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>