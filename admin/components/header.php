<div class="header">
    <?php $user = json_decode($_SESSION['user']); ?>
    <h1>Hello! <?php echo $user->first_name; ?></h1>
    <hr>
</div>