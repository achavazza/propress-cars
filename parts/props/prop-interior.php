<div class="block">
    <div class="block-title">
        <h3 class="title is-4">
            <?php echo __('Interior', 'tnb'); ?>
        </h3>
    </div>
    <div class="block-content">
        <?php $ints = get_the_terms($post, 'interior'); ?>
        <?php
        //pr($ints);
        if($ints){
            echo '<ul class="list-unstyled list-2-cols">';
            foreach ( $ints as $int ) {
                echo $int ? sprintf('<li><i class="icon-star"></i> %s</li>', $int->name) : '';
            }
            echo '</ul>';
        }
         ?>
        <?php /*
        <?php
        $tasks = explode( ';', get_post_meta( get_the_ID(), '_prop_interior', true ) );
        if($tasks){
            echo '<ul class="list-unstyled">';
            foreach ( $tasks as $task ) {
                printf('<li>%s</li>', $task);
            }
            echo '</ul>';
        }
        ?>
        */ ?>
    </div>
</div>
