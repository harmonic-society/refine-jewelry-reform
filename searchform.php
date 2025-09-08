<?php
/**
 * Search Form Template
 * @package RefineJewelryReform
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text">検索:</span>
        <input type="search" class="search-field" placeholder="検索..." value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit btn">
        <span class="search-submit-text">検索</span>
    </button>
</form>