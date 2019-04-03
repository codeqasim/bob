<?php echo $this->render_table_name($mode); ?>

<div class="xcrud-view">
    <?php echo $mode == 'view' ? $this->render_fields_list($mode, array('tag' => 'table', 'class' => 'table')) : $this->render_fields_list($mode, 'div', 'div', 'label', 'div'); ?>
</div>

<div class="xcrud-top-actions btn-group">
    <?php
    echo $this->render_button('save_return', 'save', 'list', 'btn btn-primary btn-lg', '', 'create,edit');
    echo $this->render_button('save_new', 'save', 'create', 'btn btn-default btn-lg', '', 'create,edit');
    echo $this->render_button('save_edit', 'save', 'edit', 'btn btn-default btn-lg', '', 'create,edit');
    echo $this->render_button('return', 'list', '', 'btn btn-warning btn-lg');
    ?>
</div>

<div class="xcrud-nav">
    <?php echo $this->render_benchmark(); ?>
</div>