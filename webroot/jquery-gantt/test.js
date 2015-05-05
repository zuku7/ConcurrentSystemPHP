<script src="js/jquery.min.js"></script>
	<script src="js/jquery.fn.gantt.js"></script>
	<script src="moment.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script src="http://taitems.github.com/UX-Lab/core/js/prettify.js"></script>
jQuery(function () {
           var data = [{ "name": "Step A " 
                         ,"desc": "→ Step B"  
                         ,"values": 
                            [{ "id"          : "b0"
                              , "from"       : "/Date(1320182000000)/"
                              , "to"         : "/Date(1320301600000)/"
                              , "desc"       : "Id: 0<br/>Name: Step A"
                              , "label"      : "Step 1"
                              , "customClass": "ganttRed"
                            }]
                       }];
            jQuery(".gantt").gantt({
                source: data
            });
        });