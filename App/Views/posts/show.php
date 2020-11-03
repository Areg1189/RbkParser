<div class="row">
    <h1 class="text-center"><?= $post->title?></h1>
    <?php if ($post->sub_title):?>
        <p class="h5"><?= $post->sub_title?></p>
    <?php endif;?>
    <?php if ($post->image_name):?>
    <div class="w-100">
        <img class="img-fluid rounded mx-auto d-block" width="500" src="/images/posts/<?= $post->image_name ?>" alt="<?= $post->image_details ?>">
    </div>
    <?php endif;?>

    <div class="">
        <?= $post->body?>
    </div>
</div>