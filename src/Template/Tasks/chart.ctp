<!doctype html>


        <title>jQuery.Gantt - Test Suite 01</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
        <link rel="stylesheet" href="/jquery-gantt/css/style.css" />
        <link rel="stylesheet" href="http://taitems.github.com/UX-Lab/core/css/prettify.css" />
		<style type="text/css">
			body {
				font-family: Helvetica, Arial, sans-serif;
				font-size: 13px;
				padding: 0 0 50px 0;
			}
			.contain {
				width: 800px;
				margin: 0 auto;
			}
			h1 {
				margin: 40px 0 20px 0;
			}
			h2 {
				font-size: 1.5em;
				padding-bottom: 3px;
				border-bottom: 1px solid #DDD;
				margin-top: 50px;
				margin-bottom: 25px;
			}
			table th:first-child {
				width: 150px;
			}
		</style>



			<h1>
				jQuery.Gantt
				<small>&mdash; Test Suite 01</small>
			</h1>

			<p>
				<strong>Expected behaviour:</strong> Gantt bar should run from "now" until 2 hours from now. It fails when all the bars are docked left at the hour view.
			</p>

			<p>
				<strong>Manual validation:</strong>
				<ul>
					<li>Passing</li>
				</ul>
			</p>
				
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
			var andTwoHours = moment().add("hours",2);

			var today_friendly = "/Date(" + today.valueOf() + ")/";
			var next_friendly = "/Date(" + andTwoHours.valueOf() + ")/";

			$(".gantt").gantt({
				source: [{
					name: "Testing",
					desc: " ",
					values: [{
						from: today_friendly,
						to: next_friendly,
						label: "Test", 
						customClass: "ganttRed"
					}]
				}],
				scale: "hours",
				minScale: "hours",
				navigate: "scroll"
			});

			$(".gantt").popover({
				selector: ".bar",
				title: "I'm a popover",
				content: "And I'm the content of said popover.",
				trigger: "hover"
			});

		});

    </script>
