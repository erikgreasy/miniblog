<?php 


    try {
        $post = get_post_by_slug();
    } catch( PDOException $e ) {
        $post = false;
    }

    if( !$post ) {
        header( "Location: /" );
    }


    require_once( 'partials/header.php' ); ?>





<div class="container my-5">

    <h1 class="text-center">Supreme post</h1>
    <div class="row">
        <?php 
        
            echo '<pre class="bg-light">';
            print_r( $post );
            echo '</pre>';
        ?>

    </div>


</div>






<?php require_once( 'partials/footer.php' ); ?>