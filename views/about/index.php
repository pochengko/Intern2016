
<div class="container-fluid text-center">
          <div class="row content">
            <div class="col-sm-2 sidenav">
              <ul class="nav nav-pills nav-stacked">
              <?php foreach($about as $about_item): ?>
                <li><a href="/about/<?php echo $about_item['aboutTitle']; ?>"><?php echo $about_item['aboutTitle'] ?></a></li>
              <?php endforeach ?>
            </ul>

            </div>
            <div class="col-sm-8 text-left">
              <?php foreach($text as $text_item): ?>
                <h3><?php echo $text_item['aboutTitle'] ?></h3>
                <div class="main">
                  <?php echo $text_item['aboutText'] ?>
                </div>
              <?php endforeach ?>
            </div>

            <div class="col-sm-2 sidenav">
            </div>
        </div>
      </div>
