<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row-fluid">
  <ul id="que-sort-code-breadcrumbs" class="breadcrumb span12">
    <li><a>Question Sort</a><span class="divider">/</span></li>
    <?php
    $hierachy = array();
    while ($childCode != "Root") {
      array_push($hierachy, $childCode);
      $childCode = QuestionSort::getParentCode($childCode)->parent_code;
    }
    $hierachyLength = count($hierachy)-1;
    for ($i = $hierachyLength; $i >= 0; $i--):
      ?>
      <?php if ($i !=  0): ?>
        <li><a class="que-sortcode-child"><?php echo $hierachy[$i]; ?></a><span class="divider">/</span></li>
      <?php else: ?>
        <li class = "active"><?php echo $hierachy[0]; ?></li>
      <?php endif; ?>
    <?php endfor; ?>
  </ul>
  <div class="row-fluid">
    <ul id="que-sort-code-container" class="nav nav-tabs nav-stacked span4">
      <?php foreach ($sortcodes as $sortcode): ?>
        <li><a class="que-sortcode-child"><?php echo $sortcode->child_code; ?></a></li>
      <?php endforeach; ?>
    </ul>
    <div  id="que-browse-result" class="span8">
      
    </div>
  </div>
</div>
