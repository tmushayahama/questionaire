<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="que-selected-filter-row row-fluid"
    selected-filter-id="<?php echo $filterTypeId; ?>">
  <div class="span2 que-filter-type">
    <?php echo $filterType; ?>
  </div>
  <div class="span9 que-filter-selected">
    <?php echo $filterSelected; ?>
  </div>
  <div class="span1 que-filter-cancel">
    <button class="que-remove-filter pull-right que-btn que-btn-grey-1">X</button>
  </div>
</div>