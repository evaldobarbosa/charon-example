<?php include "header.php"; ?>

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Charon <small>a simple db tool</small></h1>
        <p class="lead">Retrieve objects and related data with a fluid syntax.</p>
        <p><a class="btn btn-lg btn-success" href="https://github.com/evaldobarbosa/charon" role="button" target="">Get started today</a></p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2><a href="/posts/read/<? echo $first->id; ?>"><? echo $first->title; ?></a></h2>
          <p class="text-danger">
            <? echo $first->contents; ?>
          </p>
          <ul>
          <?
            foreach ($posts as $key => $value) {
              echo "<li><a href=\"/posts/read/{$value->id}\">{$value->title}</a></li>";
            }
          ?>
          </ul>
        </div>
        <div class="col-lg-4">
          <h2>Authors</h2>
          <p>All authors are here. Select one of them and all his posts are listed.</p>
          <ul>
          <?
            foreach ($authors as $key => $value) {
              echo "<li><a href=\"/authors/list/{$value->id}\">{$value->name} ({$value->count('posts')})</a></li>";
            }
          ?>
          </ul>
       </div>
        <div class="col-lg-4">
          <h2>Tags</h2>
          <p>Select one tag and view all posts related.</p>
          <ul>
          <?
            foreach ($tags as $key => $value) {
              echo "<li><a href=\"/authors/list/{$value->id}\">{$value->name} ({$value->count('tags')})</a></li>";
            }
          ?>
          </ul>
        </div>
      </div>

      <!-- Site footer -->
      <div class="footer">
        <p>&copy; Evaldo Barbosa 2013</p>
        <address>evaldobarbosa@gmail.com</address>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap.min.css" type="text/css" />
</html>
