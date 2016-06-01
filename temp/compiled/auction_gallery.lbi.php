<?php if ($this->_var['pictures']): ?>
<div id="gallery_list">
    <a id="gallery_left"></a>
    <a id="gallery_right"></a>
    <div class="items">
        <ul>
            <?php $_from = $this->_var['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');$this->_foreach['pictures'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pictures']['total'] > 0):
    foreach ($_from AS $this->_var['picture']):
        $this->_foreach['pictures']['iteration']++;
?>
            <li>
                <a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $this->_var['picture']['img_url']; ?>',largeimage: '<?php echo $this->_var['picture']['img_original']; ?>'}" <?php if ($this->_foreach['pictures']['iteration'] == 1): ?>class="zoomThumbActive"<?php endif; ?>><img src="<?php echo $this->_var['picture']['thumb_url']; ?>"></a>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
</div>
<?php endif; ?>
