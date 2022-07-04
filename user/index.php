<?php
$page = 'index';
require('./assets/require/head.php');
?>
<div class="wrapper">

  <main>
    <div class="col2 hero">
      <h1>A Teaching Platform with Flexibilit, Finally.</h1>
      <div class="form">
        <label for="email">Notify me when it releases:</label>
        <div class="col2">
          <input type="text" id="email" placeholder="Email Address">
          <input type="submit" value="Add me">
        </div>
      </div>
    </div>
    <div class="features">
      <div class="card">
        <p class="title">Modular</p>
        <p class="desc">Go beyond teaching with just video. Choose from our library of interactive modules or create your own.</p>
      </div>
      <div class="card">
        <p class="title">Customizable</p>
        <p class="desc">Use our Headless API to build truly custom frontends.</p>
      </div>
      <div class="card">
        <p class="title">PPP &amp; Managed Payments</p>
        <p class="desc">Offer parity pricing, and leave the headache of processing to us.</p>
      </div>
      <div class="card">
        <p class="title">Built by Teachers</p>
        <p class="desc">Co-Founder Gary Simon has been teaching online for over 12 years. We know what teachers want.</p>
      </div>
    </div>
  </main>
</div>

<?php
require('./assets/require/foot.php');
?>