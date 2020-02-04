<!--Admin Edit -->

<?php
if (isset($this->session->userdata['logged_in'])) {
  $username = ($this->session->userdata['logged_in']['username']);
} else {
  header("location: http://0711.pocheng.farwin.tw/fail");
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title ?>
      <small>Control panel</small>
    </h1>

    <ul class="breadcrumb">
      <li><a href="<?php echo site_url("login"); ?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>
      <li><a href="<?php echo site_url("admin/about"); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
      <li class="active"><?php echo ucfirst($this->uri->segment(3));?></li>
      <li class="active"><?php echo $about_item['aboutTitle'];;?></li>
    </ul>

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->

        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/about/edit');?>

        <form class="form-horizontal" role="form">
          <div class="form-group">
            <input type="text" name="aboutID" value="<?php echo $about_item['aboutID']; ?>" hidden />
            <label for="aboutTitle" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="aboutTitle" value="<?php echo $about_item['aboutTitle']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="aboutText" class="col-sm-2 control-label">Text</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="aboutText" rows="5" ><?php echo $about_item['aboutText']; ?></textarea>
              <script>
                CKEDITOR.replace( 'aboutText' );
              </script>
            </div>
          </div>

          <div class="form-group">
            <label for="aboutState" class="col-sm-2 control-label">State</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="aboutState" value="<?php echo $about_item['aboutState']; ?>" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary" name="submit" />Edit</button>
            </div>
          </div>
        </form>

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
