<div class="column">	
<?foreach ($side_task_board as $task) { ?>
	<div class="portlet draggable ui-widget ui-widget-content ui-helper-clearfix ui-corner-all<?if(!$task['completed']){?> todo<?}?><?if(!$task['completed'] && isset($task['start']) && $task['start']<$this->date->now){?> expired<?}?>" event-id="<?=$task['id']?>" data-completed="<?=(int)$task['completed']?>">
		<div class="portlet-header ui-widget-header ui-corner-all ellipsis">
			<span class='ui-icon ui-icon-minusthick'></span>
			<?=$task['name'] ?>
		</div>
		<div class="portlet-content"><?=str_getSummary($task['content'],60)?>
<?	if(isset($task['project'])){?>
			<hr /><span class="project">事务：<?=$task['project_name']?></span>
<?}?>
		</div>
	</div>
<?}?>
</div>