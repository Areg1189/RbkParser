<div class="row">
    <?php foreach ($posts as $post): ?>
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <div class="card-body">
                    <p class="card-text"><?= mb_strimwidth(strip_tags($post->body), 0,200)?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/post/<?= $post->slug?>" class="btn btn-sm btn-outline-secondary">Подробнее</a>

                        <small class="text-muted"><?= date('d-m-Y H:i', strtotime($post->post_date))?></small>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>
