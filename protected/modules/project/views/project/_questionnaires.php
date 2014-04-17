<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ 
$row = 1;
foreach ($projectQuestionnaires as $projectQuestionnaire):
  ?>
  <tr class="que-questionnaire-entry" user-questionnaire-id="<?php echo $projectQuestionnaire->userQuestionnaire->id ?>">
    <td class="">
      <?php echo $row++; ?>
    </td>
    <td class="name">
      <h4><?php echo CHtml::link($projectQuestionnaire->userQuestionnaire->name, array(Yii::app()->getModule('project')->viewQuestionnaireUrl, 'projectId' => $projectQuestionnaire->project_id, 'questionnaireId' => $projectQuestionnaire->userQuestionnaire->id), array('class' => '')); ?></h4>
      <p><i class="que-space-right">Created: 12/12/12</i> <i>Last Modified: 12/12/12</i></p>
    </td>
    <td class="">
      <div class="pull-right btn-group">
        <button id="" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown"><i class ="glyphicon glyphicon-file"></i></button>
        <button class="btn dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a class="copy-questionnaire-modal-trigger">Copy To</a></li>
          <li><a class="move-questionnaire-modal-trigger">Move To</a></li>
          <li><a class="que-delete-questionnaire-btn">Delete</a></li>
        </ul>
      </div>
    </td>
  </tr>
<?php endforeach; ?>

