<div class="card block">
    <div class="card-header">
        <h3 class="card-header-title">
            <?php echo __('Adicionales', 'tnb'); ?>
        </h3>
    </div>
    <div class="card-content">
        <?php $ints = get_the_terms($post, 'additional'); ?>
        <?php
        //pr($ints);
        if($ints){
            echo '<ul class="list-unstyled">';
            foreach ( $ints as $int ) {
                printf('<li>%s</li>', $int->name);
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
