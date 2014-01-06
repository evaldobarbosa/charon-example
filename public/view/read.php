<?php include "header.php"; ?>

      <div>
      	<h1>
      		<?php echo $post->title; ?>
      		<small>by <?php echo $post->author->name; ?> at <?php echo $post->created; ?></small>
      	</h1>
      	<?php echo $post->contents; ?>
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
</html>
