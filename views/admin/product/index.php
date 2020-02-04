<!--Admin Product Index -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title ?>
      <small>Control panel</small>
    </h1>

    <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("login"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="table-responsive">

        <table class="table table-hover">
          <tr>
            <th width="10%">編號</th>
            <th width="35%">分類</th>
            <th width="35%">名稱</th>
            <th width="10%">修改</th>
            <th width="10%">刪除</th>
          </tr>
      <?php foreach ($admin_product as $product_item): ?>
          <tr>
            <td><?php echo $product_item['p_id']?></td>
            <td><?php echo $product_item['p_classID']?></td>
            <td><a href="/admin/product/view/<?php echo $product_item['p_id'] ?>"><?php echo $product_item['p_name']?></a></td>
            <td><a href="/admin/product/edit/<?php echo $product_item['p_id'] ?>">Edit</a></td>
            <td><a href="/admin/product/del/<?php echo $product_item['p_id'] ?>">Delete</a></td>
          </tr>
      <?php endforeach ?>
        </table>
        <div align="center">
        <?php echo $link ?>
      </div>
      </div>

        <input type="button" value="新增" class="btn btn-primary" onclick="window.location.href='/admin/product/create'">

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
