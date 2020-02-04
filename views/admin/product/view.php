<!--Admin Product View -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php
      echo $product_item['p_name'];
      ?>
      <small>Control panel</small>
    </h1>

    <ul class="breadcrumb">
      <li><a href="<?php echo site_url("login"); ?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>
      <li><a href="<?php echo site_url("admin/product"); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
      <li class="active"><?php echo ucfirst($this->uri->segment(3));?></li>
      <li class="active"><?php echo $product_item['p_name'];?></li>
    </ul>

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="col-sm-7">

        <img src="/<?php echo $product_item['p_filepath'] ?>" style="width:60%">
        <?php
        echo "<br/>";
        echo "<br/>";
        echo '<label>Class :</label> '.$product_item['p_classID'].'';
        echo "<br/>";
        echo "<br/>";
        echo '<label>Describe :</label> '.$product_item['p_describe'].'';
        echo "<br/>";
        echo "<br/>";
        echo '<label>Detail:</label> '.$product_item['p_detail'].'';
        echo "<br/>";
        echo '<label>Spec:</label> ';

        ?>

        <?php foreach ($spec as $key => $value): ?>
        <p><?php echo $key?> : <?php echo $value?></p>
      <?php endforeach ?>
        <input type="button" onclick="history.back()" value="Return" class="btn btn-primary"></input>
        </div>

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
