<?php
//grab data
$data            = get_post_meta($post->ID);
$thumb           = get_the_post_thumbnail($post->ID, 'thumb');
$phone           = $data['_agent_phone'][0];
$whats           = $data['_agent_whatsapp'][0];
$email           = $data['_agent_email'][0];
$type            = get_the_terms($post->ID, 'agent_type')[0];
?>
<div <?php post_class('media') ?> id="post-<?php the_ID(); ?>">
    <div class="media-left">
        <a class="image" href="<?php the_permalink() ?>">
            <?php if($thumb): ?>
                <?php echo $thumb ?>
            <?php else: ?>
                <img src="<?php echo get_attachment_url_by_slug('default', 'thumb') ?>" />
            <?php endif; ?>
        </a>
    </div>
    <div class="media-content">
        <a href="<?php the_permalink() ?>">
            <span class="h3">
                <?php the_title(); ?>
            </span>
        </a>
        <?php if($type): ?>
            <span class="h4">
                <?php echo $type->name; ?>
            </span>
        <?php endif; ?>
        <br />
        <ul class="info-list">
            <?php
            if($email){
                $email_link = sprintf('<a href="mailto:%s">%s</a>', $email, $email);
            }
            echo $phone ? sprintf('<li><i class="icon qs-icon icon-phone"></i><span>%s</span></li>', $phone) : '';
            echo $whats ? sprintf('<li><i class="icon qs-social icon-whatsapp"></i><span>%s</span></li>', $whats) : '';
            echo $email ? sprintf('<li><i class="icon qs-icon icon-mail"></i><span>%s</span></li>', $email_link) : '';
            ?>
        </ul>
    </div>
</div>
