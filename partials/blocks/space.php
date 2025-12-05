<?php $id = 'space-' . $block['id']; ?>
<div data-id="<?php echo $id; ?>" class="block-space" style="--data-padding: <?php echo (get_field('espaco_entre_bloco') == 'outro') ? get_field('outro_valor') : get_field('espaco_entre_bloco'); ?>px">

</div>