
<?php


/**
 * Get Segments
 * 
 * From an url like http://example.com/edit/5
 * creates an array of URI segments [edit, 5]
 * 
 * @return array
 */
function get_segments() {

    $current_url = 'http' .
        ( isset( $_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'  ? 's://' : '://' ) .
        $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ;
    

    $path = str_replace( BASE_URL, '', $current_url );
    $path = parse_url( $path, PHP_URL_PATH );


    $segments = explode( '/', trim( $path, '/' ) );
    

    return $segments;
}


/**
 * Segment
 * 
 * Returns the index-th URI segment
 * 
 * @param $index
 * @return string or false
 */
function segment( $index ) {
    $segments = get_segments();

    return isset( $segments[ $index-1 ] ) ? $segments[ $index-1 ] : false;
    
}


/**
 * Show 404
 * 
 * Shows 404 page 
 */
function show_404() {
    header( "HTTP/1.0 404 Not Found" );
    include_once( '404.php' );
    die();
}



function get_posts() {

    global $db;

    $query = $db->query(
        "SELECT * FROM POSTS;"
    );


    if( $query->rowCount() ) {

        $results =  $query->fetchAll( PDO::FETCH_ASSOC );
    } else {
        $results = [];
    }

    return $results;

}


function word_limiter( $str, $limit = 100, $end_char = '&#8230;' ) {
    
    if( trim( $str ) === '' ) {
        return $str;
    }

    preg_match( '/^\s*+(?:\S++\s*+){1,' . (int) $limit . '}/', $str, $matches );

    if( strlen( $str == strlen( $matches[0] ) ) ) {
        $end_char = '';
    }

    return rtrim( $matches[0] ) . $end_char;
}



/**
 * Plain
 * 
 * Prevents cross site scripting by escaping (from alcatraz)
 * 
 * @param string $str
 * @return string
 */
function plain( $str ) {
    return htmlspecialchars( $str, ENT_QUOTES );
}



function format_post( $post ) {
    return (object)$post;
}


function get_post_by_slug( $slug = "" ) {
    global $db;


    if( !$slug && !$slug = segment(2) ) {
        return false;
    }

    $query = $db->prepare(
        "SELECT * FROM POSTS
        WHERE slug = :slug;"
    );

    $query->execute( [ 'slug' => $slug ] );

    if( $query->rowCount() === 1 ) {

        $result = $query->fetch( PDO::FETCH_OBJ );
    } else {
        $result = [];
    }

    return $result;
}