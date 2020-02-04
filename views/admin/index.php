<?php
if (isset($this->session->userdata['logged_in'])) {
  $username = ($this->session->userdata['logged_in']['username']);
  
} else {
  header("location: http://0711.pocheng.farwin.tw/login");
}
?>


<h2><?php //echo $title ?></h2>

    <?php foreach ($news as $news_item): ?>
    <h3><?php echo $news_item['id'], ". " , $news_item['title'] ?></h3>
    <div class="main">
        <?php echo $news_item['date_time'] ?>
    </div>
        <td><a href="news/<?php echo $news_item['slug'] ?>">View article</a></td>
        <td><a href="news/edit/<?php echo $news_item['title'] ?>" >Edit</a></td>
        <td><a href="news/del/<?php echo $news_item['id'] ?>">Delete</a></td>
    </tr>
    <?php endforeach ?>


<br><br>
<a class="btn btn-primary" href="news/create">Add New Article</a>

<br><br>
