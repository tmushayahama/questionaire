<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-lg-12 col-sm-12 col-xs-12">
  <div class="que-selected-filter-row row alert alert-info"
       selected-filter-id="<?php echo $filterTypeId; ?>">
    <div class="col-lg-1 col-sm-2 hidden-xs que-filter-type">
      <?php echo $filterType; ?>
    </div>
    <div class="col-lg-10 col-sm-9 col-xs-10 que-filter-selected">
      <?php echo $filterSelected; ?>
    </div>
    <div class="col-lg-1 col-sm-1 col-xs-2 que-filter-cancel">
      <button class="que-remove-filter pull-right btn btn-default">X</button>
    </div>
  </div>
</div>