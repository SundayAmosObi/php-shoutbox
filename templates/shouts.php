<h1> Welcome To My Shout Box </h1>
<div class="bigbox">
    <div class="messagebox">
        <?php foreach ($messages as $post): ?>
            <p><?php echo htmlspecialchars($post['nickname']); ?></p>
            <h3><?php echo htmlspecialchars($post['message']); ?></h3>
        <?php endforeach; ?>
    </div>
    <div class="inputbox">
        <?php if(!isset($_SESSION['nickname'])){
            $this->join();
        } else {
            $this->send();
        } ?>

    </div>
</div>
