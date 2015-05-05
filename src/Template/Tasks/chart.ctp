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
			"use strict";
			$(".gantt").gantt({
				source: [{
					name: "Sprint 0",
					desc: "Analysis",
					values: [{
						from: "/Date(1320192000000)/",
						to: "/Date(1322401600000)/",
						label: "Requirement Gathering",
						customClass: "ganttRed"
					}]
				},{
					name: " ",
					desc: "Scoping",
					values: [{
						from: "/Date(1322611200000)/",
						to: "/Date(1323302400000)/",
						label: "Scoping",
						customClass: "ganttRed"
					}]
				},{
					name: "Sprint 1",
					desc: "Development",
					values: [{
						from: "/Date(1323802400000)/",
						to: "/Date(1325685200000)/",
						label: "Development",
						customClass: "ganttGreen"
					}]
				},{
					name: " ",
					desc: "Showcasing",
					values: [{
						from: "/Date(1325685200000)/",
						to: "/Date(1325695200000)/",
						label: "Showcasing",
						customClass: "ganttBlue"
					}]
				},{
					name: "Sprint 2",
					desc: "Development",
					values: [{
						from: "/Date(1326785200000)/",
						to: "/Date(1325785200000)/",
						label: "Development",
						customClass: "ganttGreen"
					}]
				},{
					name: " ",
					desc: "Showcasing",
					values: [{
						from: "/Date(1328785200000)/",
						to: "/Date(1328905200000)/",
						label: "Showcasing",
						customClass: "ganttBlue"
					}]
				},{
					name: "Release Stage",
					desc: "Training",
					values: [{
						from: "/Date(1330011200000)/",
						to: "/Date(1336611200000)/",
						label: "Training",
						customClass: "ganttOrange"
					}]
				},{
					name: " ",
					desc: "Deployment",
					values: [{
						from: "/Date(1336611200000)/",
						to: "/Date(1338711200000)/",
						label: "Deployment",
						customClass: "ganttOrange"
					}]
				},{
					name: " ",
					desc: "Warranty Period",
					values: [{
						from: "/Date(1336611200000)/",
						to: "/Date(1349711200000)/",
						label: "Warranty Period",
						customClass: "ganttOrange"
					}]
				}],
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