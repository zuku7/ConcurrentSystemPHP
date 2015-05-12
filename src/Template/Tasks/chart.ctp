    <?= $this->Html->css('style.css') ?>
     <?= $this->Html->css('style2.css') ?>
    <?= $this->Html->css('http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') ?>
     <?= $this->Html->css('http://taitems.github.com/UX-Lab/core/css/prettify.css') ?>
     <?= $this->Html->css('/js/style.css') ?>
<!doctype html>


        
   



				
			<div class="gantt"></div>



	<script src="/jquery-gantt/js/jquery.min.js"></script>
	<script src="/jquery-gantt/js/jquery.fn.gantt.js"></script>
	<script src="/jquery-gantt/moment.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script src="http://taitems.github.com/UX-Lab/core/js/prettify.js"></script>
    <script>
		$(function() {

			"use strict";

			var today = moment();
			var andTwoHours = moment().add("hours", 2);

			var today_friendly = "/Date(" + today.valueOf() + ")/";
			var next_friendly = "/Date(" + andTwoHours.valueOf() + ")/";

			$(".gantt").gantt({
				source : [{
					name : "Testing",
					desc : " ",
					values : [{
						from : today_friendly,
						to : next_friendly,
						label : "Test",
						customClass : "ganttRed"
					}]
				}],
				scale : "hours",
				minScale : "hours",
				navigate : "scroll"
			});

			$(".gantt").popover({
				selector : ".bar",
				title : "I'm a popover",
				content : "And I'm the content of said popover.",
				trigger : "hover"
			});

		});

		$(".selector").gantt({
			source : "ajax/data.json",
			scale : "weeks",
			minScale : "weeks",
			maxScale : "months",
			onItemClick : function(data) {
				alert("Item clicked - show some details");
			},
			onAddClick : function(dt, rowId) {
				alert("Empty space clicked - add an item!");
			},
			onRender : function() {
				console.log("chart rendered");
			}
		});

    </script>
    	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.fn.gantt.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="http://taitems.github.com/UX-Lab/core/js/prettify.js"></script>
  <script>

		$(function() {
		<?php 
			echo	'"use strict";' . PHP_EOL;
			echo	'$(".gantt").gantt({' . PHP_EOL;
			echo		'source: [{' . PHP_EOL;
			echo			'name: " ",' . PHP_EOL;
			echo			'desc: "' . $tasks->first()->name . '",' . PHP_EOL;
			echo			'values: [{' . PHP_EOL;
			$start1 = strtotime($tasks->first()->start);
			$end1 = strtotime($tasks->first()->end);
			$start1 *= 1000;
			$end1 *= 1000;
			echo				'from: "/Date(' . $start1 . ')/",' . PHP_EOL;
			echo				'to: "/Date(' . $end1 . ')/",' . PHP_EOL;
			echo				'label: "Requirement Gathering",' . PHP_EOL;
			echo				'customClass: "ganttRed"' . PHP_EOL;
			echo			'}]' . PHP_EOL;
			echo		'}' . PHP_EOL;
				
				$numtasks = count($tasks);
				$i = -1;
				foreach ($tasks as $task): 	
				$i++;
				if($i === 0) continue;
				echo	',{' . PHP_EOL;
				echo	'name: " ",' . PHP_EOL;
				echo	'desc: "' . $task->name . '",' . PHP_EOL;
				echo	'values: [{' . PHP_EOL;
				$startTime = strtotime($task->start);
				$endTime = strtotime($task->end);
				$startTime *= 1000;
				$endTime *= 1000;
				echo	'from: "/Date(' . $startTime . ')/",' . PHP_EOL;
				echo	'to: "/Date(' . $endTime . ')/",' . PHP_EOL;
				echo	'label: "' . $task->name . '",' . PHP_EOL;
				echo	'customClass: "ganttRed"' . PHP_EOL;
				echo	'}]' . PHP_EOL;
				echo	'}' . PHP_EOL;
				 endforeach; ?>
				],
				navigate: "scroll",
				maxScale: "hours",
				itemsPerPage: 10,
				onItemClick: function(data) {
					alert("Item clicked - show some details");
				},
				onAddClick: function(dt, rowId) {
					alert("Empty space clicked - add an item!");
				},
				onRender: function() {
					if (window.console && typeof console.log === "function") {
						console.log("chart rendered");
					}
				}
			});
			$(".gantt").popover({
				selector: ".bar",
				title: "I'm a popover",
				content: "And I'm the content of said popover.",
				trigger: "hover"
			});
			prettyPrint();
		});
  </script>

    </body>


</html>