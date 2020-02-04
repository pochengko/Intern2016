<!--Admin Contact View -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>

    <ul class="breadcrumb">
      <li><a href="<?php echo site_url("login"); ?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>
      <li><a href="<?php echo site_url("admin/contact"); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
      <li class="active"><?php echo ucfirst($this->uri->segment(3));?></li>
      <li class="active"><?php echo $contact_item['c_name'];?></li>
    </ul>

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <h2><?php echo $title ?></h2>

        <?php
        echo '<label>Email :</label> '.$contact_item['c_email'].'';
        echo "<br/>";
        echo "<br/>";
        echo '<label>Content :</label> '.$contact_item['c_content'].'';
        echo "<br/>";
        echo "<br/>";
        echo '<label>Date :</label> '.$contact_item['c_date_time'].'';
        echo "<br/>";
        echo "<br/>";?>
        <input type="button" onclick="history.back()" value="Return" class="btn btn-primary"></input>

      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.3.6
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

</body>
</html>
