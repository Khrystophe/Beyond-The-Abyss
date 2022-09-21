<script>
  <?php

  $req = $bdd->prepare('SELECT title, composer FROM contents');
  $req->execute();

  while ($contents = $req->fetch()) {
    $titles[] = $contents['title'];
    $composers[] = $contents['composer'];
  }; ?>

  let titles = <?= json_encode($titles) ?>;
  let composers = <?= json_encode($composers) ?>;
</script>