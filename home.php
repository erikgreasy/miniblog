<?php require_once( 'partials/header.php' ); ?>


<?php 

    echo '<pre class="bg-light">';

    $results = get_posts();
    echo '</pre>';

?>


<div class="container my-5">

    <h1 class="text-center">Supreme post</h1>
    <div class="row">
        <div class="col-10 offset-1">

        <?php if( count( $results ) ): foreach( $results as $post ): $post = format_post( $post ) ?>

            <article class="my-5">
                <h2 class="post-title"><a href="<?php echo BASE_URL . '/post/' . $post->slug ?>"><?= $post->title ?></a></h2>
                <time datetime="<?= date( 'Y-m-d', strtotime( $post->created_at ) ) ?>">
                    <small><?= date( 'j M Y, G:i', strtotime( $post->created_at ) ) ?></small>
                </time>
                <p class="post-text"><?= word_limiter( plain( $post->text ), 40 ) ?></p>
                <a href="<?php echo BASE_URL . '/post/' . $post->slug ?>" class="read-more-btn btn btn-primary">Read more</a>
            </article>

        <?php endforeach; else: ?>
            <p>sorry nothing here to see :(</p>
        <?php endif; ?>

        </div>

    </div>


</div>






<?php require_once( 'partials/footer.php' ); ?>