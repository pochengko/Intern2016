<!--Admin Edit -->
<?php
if (isset($this->session->userdata['logged_in'])) {
  $username = ($this->session->userdata['logged_in']['username']);
} else {
  header("location: http://0711.pocheng.farwin.tw/fail");
}
?>
<style>
html, body {

}

[data-role="dynamic-fields"] > .form-inline + .form-inline {
    margin-top: 0.5em;
}

[data-role="dynamic-fields"] > .form-inline [data-role="add"] {
    display: none;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="add"] {
    display: inline-block;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="remove"] {
    display: none;
}
</style>
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
      <?php //echo $error; ?>
      <?php echo validation_errors(); ?>
      <?php echo form_open_multipart('admin/product/edit/'.$this->uri->segment(4).'');?>

      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->

        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label for="img" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-10">
              <img src="/<?php echo $product_item['p_filepath']; ?>" style="width:20%" class="img-thumbnail">
            </div>
          </div>
          <div class="form-group">
            <label for="img" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="userfile" size="20" required />
              <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
              <div>
                <img class="preview" style="max-width: 150px; max-height: 150px;">
                <div class="size"></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" name="p_id" value="<?php echo $product_item['p_id']; ?>" hidden />
            <label for="p_filepath" class="col-sm-2 control-label">Path</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="p_filepath" value="<?php echo $product_item['p_filepath']; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="p_name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="p_name" value="<?php echo $product_item['p_name']; ?>" />
            </div>
          </div>
          <div class="form-group">
            <?php
            echo '<label for=p_classID" class="col-sm-2 control-label">Class</label>';
            //echo form_dropdown('manufacture_id', $options_manufacture, '', 'class="span2"');
            echo '<div class="col-sm-10">';
            echo form_dropdown('p_classID', $category_list, set_value('p_classID'), 'class="form-control" required');
            echo '</div>';
            ?>
          </div>
          <div class="form-group">
            <label for="p_describe" class="col-sm-2 control-label">Describe</label>
            <div class="col-sm-10">
              <input type="text" name="p_describe" class="form-control" value="<?php echo $product_item['p_describe']; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="p_detail" class="col-sm-2 control-label">Detail</label>
            <div class="col-sm-10">
              <textarea name="p_detail" class="form-control" rows="5" ><?php echo $product_item['p_detail']; ?></textarea>
              <script>
                CKEDITOR.replace( 'p_detail' );
              </script>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary" name="submit" />Edit</button>
            </div>
          </div>

      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">

        <div class="col-md-12">
          <label>Spec</label>
          <div data-role="dynamic-fields">
            <?php foreach($spec as $keys=>$values):?>
            <div class="form-inline">
              <div class="form-group">
                <label class="sr-only" for="field-name">Field Name</label>
                <input type="text" class="form-control" name="field_name[]" value="<?php echo $keys ?>" >
              </div>
              <span>-</span>
              <div class="form-group">
                <label class="sr-only" for="field-value">Field Value</label>
                <input type="text" class="form-control" name="field_value[]" value="<?php echo $values ?>" >
              </div>
              <button class="btn btn-danger" data-role="remove">
                <span class="glyphicon glyphicon-remove"></span>
              </button>
              <button class="btn btn-primary" data-role="add">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </div>  <!-- /div.form-inline -->
            <?php endforeach; ?>
          </div>  <!-- /div[data-role="dynamic-fields"] -->
        </div>  <!-- /div.col-md-12 -->


      </section>
      <!-- right col -->
    </div>
  </form>
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
