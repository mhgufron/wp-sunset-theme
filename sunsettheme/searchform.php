<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
    <div class="input-group input-group-md">
        <input type="search" class="form-control" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" title="Search">
        <span class="input-group-btn">
            <button type="button" class="btn btn-warning">Go!</button>
        </span>
    </div>
</form>
