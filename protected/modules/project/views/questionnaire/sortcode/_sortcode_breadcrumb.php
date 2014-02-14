<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<li><a>Question Sort</a><span class="divider">/</span></li>
<?php
$t;
$hierachy = array();
while ($childCode != "Root") {
  array_push($hierachy, $childCode);
  $childCode = QuestionSort::getParentCOoe($childCode)->parent_code;
}
for ($i = count($hierachy); $i >= 0; $i--):
  ?>
  <?php if ($i != 0): ?>
    <li><a><?php echo $hierachy[i]; ?></a><span class="divider">/</span></li>
  <?php else: ?>
    <li class = "active">Questionnaire</li>
  <?php endif; ?>
<?php endfor; ?>