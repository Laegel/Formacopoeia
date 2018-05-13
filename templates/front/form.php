<?php
if (!$form) {
    die('Nothing to see here.');
}
$token = md5(uniqid($form->ID));
$tabs = $form->get_tabs();
$classes = isset($tabs->editor) ? $tabs->editor->classes : '';
?>

<form 
    method="POST" 
    action="<?php echo admin_url('admin-post.php');?>" 
    data-formacopoeia="<?php echo $form->ID;?>"
    class="<?php echo $classes;?>"
>
    <input type="hidden" value="<?php echo $form->ID;?>" name="id">
    <input type="hidden" value="<?php echo $token;?>" name="token">
    <input type="hidden" value="formacopoeia_submit" name="action">
    <?php wp_create_nonce('formacopoeia_form_' . $token);?>
    <?php echo $form->post_content;?>
</form>