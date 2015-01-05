$(document).ready(function() {
var win=$(window), par, str, num, obj, obj1;

//popup
$(document).on('click', '.aboutUp', function() {
	$('.popup, .cover').fadeIn();
	return false;
});
$(document).on('click', '.popup .close, .cover', function() {
	$('.popup, .cover').fadeOut();
	return false;
});

//tabs
$(document).on('click', '.tabs .names .name', function() {
	par = $(this).parents('.tabs');
	num = par.find('.names .name').index($(this));
	
	par.find('.names .name').removeClass('active');
	$(this).addClass('active');
	
	par.find('.cTab').hide();
	par.find('.cTab').eq(num).fadeIn(400);
	
	if(par.find('.plumb').hasClass('plumb')) {
		//scheme in tabs, full copy of the main scheme
		jsPlumb.ready(function() {
		
			var instance = jsPlumb.getInstance({
				Connector:[ "Flowchart", { cornerRadius:10, stub:3 } ],//stub = min width
				PaintStyle:{
					lineWidth:3,
					strokeStyle:"#3294da"
				},
				isSource:true,
				Endpoint:[ "Dot", { radius:0 } ],
				EndpointStyle:{ fillStyle:"transparent" },
				ConnectionOverlays : [
					["Arrow", {
						location:1,
						width:9,
						length:7,
						paintStyle:{
							strokeStyle:"#3294da"
						},
						direction:1,
						foldback:1
					}]
				],
				Container:"plumbInTabs",
			});
		
			var shapes = jsPlumb.getSelector("#plumbInTabs .window");
			
			// make everything draggable
			instance.draggable(shapes, { grid: [5, 3] });
			
			//lines connection points
			var sourceAnchorsBotParent = [
				'Left',
				'TopCenter',
				'Right',
				'BottomCenter',
			];
			var sourceAnchorsTopChild = [
				[ 0.125, 0, 0, -1 ],
				[ 0.25, 0, 0, -1 ],
				[ 0.5, 0, 0, -1 ],
				[ 0.75, 0, 0, -1 ],
				[ 0.875, 0, 0, -1 ],
				[ 0.928, 0, 0, -1 ],
				[ 0.125, 1, 0, 1 ],
				[ 0.25, 1, 0, 1 ],
				[ 0.5, 1, 0, 1 ],
				[ 0.75, 1, 0, 1 ],
				[ 0.875, 1, 0, 1 ],
				[ 0.928, 1, 0, 1 ]
			];
			var sourceAnchorsLeftChild = [
				[ 1, 0.5, 1, 0 ],			
			];
			var sourceCommon = [
				[ 0.125, 0, 0, -1 ],
				[ 0.25, 0, 0, -1 ],
				[ 0.5, 0, 0, -1 ],
				[ 0.75, 0, 0, -1 ],
				[ 0.875, 0, 0, -1 ],
				//[ 0.928, 0, 0, -1 ],
				
				[ 0.125, 1, 0, 1 ],
				[ 0.25, 1, 0, 1 ],
				[ 0.5, 1, 0, 1 ],
				[ 0.75, 1, 0, 1 ],
				[ 0.875, 1, 0, 1 ],
				//[ 0.928, 1, 0, 1 ],
				
				[ 1, 0.25, 1, 0 ],
				[ 1, 0.5, 1, 0 ],
				[ 1, 0.75, 1, 0 ],
				//[ 1, 0.25, 1, 0 ],
				//[ 1, 0.5, 1, 0 ],
				//[ 1, 0.75, 1, 0 ],
				//[ 1, 0.875, 1, 0 ],
				//[ 1, 0.928, 1, 0 ],
				
				[ 0, 0.25, -1, 0 ],
				[ 0, 0.5, -1, 0 ],
				[ 0, 0.75, -1, 0 ],
				//[ 0, 0.25, -1, 0 ],
				//[ 0, 0.5, -1, 0 ],
				//[ 0, 0.75, -1, 0 ],
				//[ 0, 0.875, -1, 0 ],
				//[ 0, 0.928, -1, 0 ],
			];
			//sourceCommon = ['Left', 'Bottom', 'Top', 'Right'];
			
			//sourceCommon = [ "Perimeter", { shape:'Rectangle', anchorCount:300 }];
			//console.log(sourceCommon);
			
			//the lines
			// instance.connect({
				// source: 'flowchartWindow1',
				// target: 'flowchartWindow2',
				// anchors: [ sourceAnchorsBotParent, [ 0.928, 0, 0, -1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow1',
				// target: 'flowchartWindow3',
				// anchors: [ sourceAnchorsBotParent, sourceAnchorsTopChild ]
			// });
			// instance.connect({
				// source: 'flowchartWindow2',
				// target: 'flowchartWindow4',
				// anchors: [ [ 0.928, 1, 0, 1 ], [ 0.928, 0, 0, -1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow4',
				// target: 'flowchartWindow5',
				// anchors: [ 'Right', sourceAnchorsTopChild ]
			// });
			// instance.connect({
				// source: 'flowchartWindow3',
				// target: 'flowchartWindow6',
				// anchors: [ [ 0.09, 1, 0, 1 ], [ 0.9259, 0, 0, -1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow3',
				// target: 'flowchartWindow7',
				// anchors: [ [ 0.61, 1, 0, 1 ], [ 0.502, 0, 0, -1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow8',
				// target: 'flowchartWindow9',
				// anchors: [ 'Left', 'Right' ]
			// });
			// instance.connect({
				// source: 'flowchartWindow9',
				// target: 'flowchartWindow5',
				// anchors: [ [ 0.31, 0, 0, -1 ], [ 0.339, 1, 0, 1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow10',
				// target: 'flowchartWindow9',
				// anchors: [ [ 0.155, 0, 0, -1 ], [ 0.88, 1, 0, 1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow10',
				// target: 'flowchartWindow8',
				// anchors: [ [ 0.725, 0, 0, -1 ], [ 0.302, 1, 0, 1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow4',
				// target: 'flowchartWindow11',
				// anchors: [ [ 0.38, 1, 0, 1 ], [ 0.5, 0, 0, -1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow4',
				// target: 'flowchartWindow13',
				// anchors: [ [ 0.928, 1, 0, 1 ], [ 0.06, 0, 0, -1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow11',
				// target: 'flowchartWindow12',
				// anchors: [ [ 0.5, 1, 0, 1 ], [ 0.5, 0, 0, -1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow13',
				// target: 'flowchartWindow14',
				// anchors: [ [ 0.5, 1, 0, 1 ], [ 0.5, 0, 0, -1 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow11',
				// target: 'flowchartWindow14',
				// anchors: [ [ 1, 1, 1, 1 ], [ 0, 0, 0, 0 ] ]
			// });
			// instance.connect({
				// source: 'flowchartWindow13',
				// target: 'flowchartWindow12',
				// anchors: [ [ 0, 1, 0, 0 ], [ 1, 0, 1, 1 ] ]
			// });
			
			//the lines
			instance.connect({
				source: 'copy_flowchartWindow1',
				target: 'copy_flowchartWindow2',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow1',
				target: 'copy_flowchartWindow3',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow2',
				target: 'copy_flowchartWindow4',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow4',
				target: 'copy_flowchartWindow5',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow3',
				target: 'copy_flowchartWindow6',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow3',
				target: 'copy_flowchartWindow7',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow8',
				target: 'copy_flowchartWindow9',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow9',
				target: 'copy_flowchartWindow5',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow10',
				target: 'copy_flowchartWindow9',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow10',
				target: 'copy_flowchartWindow8',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow4',
				target: 'copy_flowchartWindow11',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow4',
				target: 'copy_flowchartWindow13',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow11',
				target: 'copy_flowchartWindow12',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow13',
				target: 'copy_flowchartWindow14',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow11',
				target: 'copy_flowchartWindow14',
				anchors: [ sourceCommon, sourceCommon ]
			});
			instance.connect({
				source: 'copy_flowchartWindow13',
				target: 'copy_flowchartWindow12',
				anchors: [ sourceCommon, sourceCommon ]
			});
			
			//endpoints
			var endpoint = ["Dot", { cssClass:"endpointClass", radius:10, hoverClass:"endpointHoverClass" } ],
			endpointStyle = { fillStyle:'#79B2DA' },
			connector = [ "Flowchart", { cornerRadius:10, stub:0 } ],
			connectorStyle = {
				lineWidth:3,
				strokeStyle:"#3294da"
			},
			anEndpoint = {
				endpoint:endpoint,
				paintStyle:endpointStyle,
				hoverPaintStyle:{ fillStyle:"#449999" },
				isSource:true, 
				isTarget:true, 
				maxConnections:-1, 
				connector:connector,
				connectorStyle:connectorStyle,
			};
			// instance.addEndpoint('flowchartWindow1', anEndpoint, {anchor:'Left'});
			// instance.addEndpoint('flowchartWindow1', anEndpoint, {anchor:'Right'});
			// instance.addEndpoint('flowchartWindow2', anEndpoint, {anchor:[ 0.928, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow3', anEndpoint, {anchor:sourceAnchorsTopChild});
			// instance.addEndpoint('flowchartWindow2', anEndpoint, {anchor:[ 0.928, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow3', anEndpoint, {anchor:[ 0.09, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow3', anEndpoint, {anchor:[ 0.61, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow4', anEndpoint, {anchor:[ 0.928, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow4', anEndpoint, {anchor:'Right'});
			// instance.addEndpoint('flowchartWindow5', anEndpoint, {anchor:[ 0.125, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow5', anEndpoint, {anchor:[ 0.339, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow8', anEndpoint, {anchor:'Left'});
			// instance.addEndpoint('flowchartWindow9', anEndpoint, {anchor:[ 0.31, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow9', anEndpoint, {anchor:[ 0.88, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow9', anEndpoint, {anchor:'Right'});
			// instance.addEndpoint('flowchartWindow10', anEndpoint, {anchor:[ 0.155, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow10', anEndpoint, {anchor:[ 0.725, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow4', anEndpoint, {anchor:[ 0.38, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow4', anEndpoint, {anchor:[ 0.928, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow6', anEndpoint, {anchor:[ 0.9259, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow7', anEndpoint, {anchor:[ 0.502, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow11', anEndpoint, {anchor:[ 0.5, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow11', anEndpoint, {anchor:[ 0.5, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow11', anEndpoint, {anchor:[ 1, 1, 1, 1 ]});
			// instance.addEndpoint('flowchartWindow12', anEndpoint, {anchor:[ 0.5, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow12', anEndpoint, {anchor:[ 1, 0, 1, 1 ]});
			// instance.addEndpoint('flowchartWindow13', anEndpoint, {anchor:[ 0.5, 1, 0, 1 ]});
			// instance.addEndpoint('flowchartWindow13', anEndpoint, {anchor:[ 0, 1, 0, 0 ]});
			// instance.addEndpoint('flowchartWindow13', anEndpoint, {anchor:[ 0.06, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow14', anEndpoint, {anchor:[ 0.5, 0, 0, -1 ]});
			// instance.addEndpoint('flowchartWindow14', anEndpoint, {anchor:[ 0, 0, 0, 0 ]});
		
			for(var i=0; i<$('#plumbInTabs .window').size(); i++) {
				for(var j=0; j<sourceCommon.length; j++) {
					instance.addEndpoint('copy_flowchartWindow'+(i+1), anEndpoint, {anchor:sourceCommon[j]});
				}
			}
		
			// bind click listener; delete connections on click
			instance.bind('click', function(conn) {
				instance.detach(conn);
			});
			
			// bind beforeDetach interceptor: will be fired when the click handler above calls detach, and the user
			// will be prompted to confirm deletion.
			instance.bind('beforeDetach', function(conn) {
				return confirm('Удалить соединение?');
			});
			
			instance.bind("connection", function(i,c) { 
				if (typeof console !== "undefined")
					console.log("connection", i.connection); 
			});
			
		});
	}
	
});

//print
$(document).on('click', '.printUp', function() {
	window.print();
	return false;
});

//main scheme
jsPlumb.ready(function() {
	
		var instance = jsPlumb.getInstance({
			Connector:[ "Flowchart", { cornerRadius:10, stub:3 } ],//stub = min width
			PaintStyle:{
				lineWidth:3,
				strokeStyle:"#3294da"
			},
			isSource:true,
			Endpoint:[ "Dot", { radius:0 } ],
			EndpointStyle:{ fillStyle:"transparent" },
			ConnectionOverlays : [
				["Arrow", {
					location:1,
					width:9,
					length:7,
					paintStyle:{
						strokeStyle:"#3294da"
					},
					direction:1,
					foldback:1
				}]
			],
			Container:"plumb",
		});
	
		var shapes = jsPlumb.getSelector("#plumb .window");
		
		// make everything draggable
		instance.draggable(shapes, { grid: [5, 3] });
		
		//lines connection points
		var sourceAnchorsBotParent = [
			'Left',
			'TopCenter',
			'Right',
			'BottomCenter',
		];
		var sourceAnchorsTopChild = [
			[ 0.125, 0, 0, -1 ],
			[ 0.25, 0, 0, -1 ],
			[ 0.5, 0, 0, -1 ],
			[ 0.75, 0, 0, -1 ],
			[ 0.875, 0, 0, -1 ],
			[ 0.928, 0, 0, -1 ],
			[ 0.125, 1, 0, 1 ],
			[ 0.25, 1, 0, 1 ],
			[ 0.5, 1, 0, 1 ],
			[ 0.75, 1, 0, 1 ],
			[ 0.875, 1, 0, 1 ],
			[ 0.928, 1, 0, 1 ]
		];
		var sourceAnchorsLeftChild = [
			[ 1, 0.5, 1, 0 ],			
		];
		var sourceCommon = [
			[ 0.125, 0, 0, -1 ],
			[ 0.25, 0, 0, -1 ],
			[ 0.5, 0, 0, -1 ],
			[ 0.75, 0, 0, -1 ],
			[ 0.875, 0, 0, -1 ],
			//[ 0.928, 0, 0, -1 ],
			
			[ 0.125, 1, 0, 1 ],
			[ 0.25, 1, 0, 1 ],
			[ 0.5, 1, 0, 1 ],
			[ 0.75, 1, 0, 1 ],
			[ 0.875, 1, 0, 1 ],
			//[ 0.928, 1, 0, 1 ],
			
			[ 1, 0.25, 1, 0 ],
			[ 1, 0.5, 1, 0 ],
			[ 1, 0.75, 1, 0 ],
			//[ 1, 0.25, 1, 0 ],
			//[ 1, 0.5, 1, 0 ],
			//[ 1, 0.75, 1, 0 ],
			//[ 1, 0.875, 1, 0 ],
			//[ 1, 0.928, 1, 0 ],
			
			[ 0, 0.25, -1, 0 ],
			[ 0, 0.5, -1, 0 ],
			[ 0, 0.75, -1, 0 ],
			//[ 0, 0.25, -1, 0 ],
			//[ 0, 0.5, -1, 0 ],
			//[ 0, 0.75, -1, 0 ],
			//[ 0, 0.875, -1, 0 ],
			//[ 0, 0.928, -1, 0 ],
		];
		//sourceCommon = ['Left', 'Bottom', 'Top', 'Right'];
		
		//sourceCommon = [ "Perimeter", { shape:'Rectangle', anchorCount:300 }];
		//console.log(sourceCommon);
		
		//the lines
		// instance.connect({
			// source: 'flowchartWindow1',
			// target: 'flowchartWindow2',
			// anchors: [ sourceAnchorsBotParent, [ 0.928, 0, 0, -1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow1',
			// target: 'flowchartWindow3',
			// anchors: [ sourceAnchorsBotParent, sourceAnchorsTopChild ]
		// });
		// instance.connect({
			// source: 'flowchartWindow2',
			// target: 'flowchartWindow4',
			// anchors: [ [ 0.928, 1, 0, 1 ], [ 0.928, 0, 0, -1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow4',
			// target: 'flowchartWindow5',
			// anchors: [ 'Right', sourceAnchorsTopChild ]
		// });
		// instance.connect({
			// source: 'flowchartWindow3',
			// target: 'flowchartWindow6',
			// anchors: [ [ 0.09, 1, 0, 1 ], [ 0.9259, 0, 0, -1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow3',
			// target: 'flowchartWindow7',
			// anchors: [ [ 0.61, 1, 0, 1 ], [ 0.502, 0, 0, -1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow8',
			// target: 'flowchartWindow9',
			// anchors: [ 'Left', 'Right' ]
		// });
		// instance.connect({
			// source: 'flowchartWindow9',
			// target: 'flowchartWindow5',
			// anchors: [ [ 0.31, 0, 0, -1 ], [ 0.339, 1, 0, 1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow10',
			// target: 'flowchartWindow9',
			// anchors: [ [ 0.155, 0, 0, -1 ], [ 0.88, 1, 0, 1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow10',
			// target: 'flowchartWindow8',
			// anchors: [ [ 0.725, 0, 0, -1 ], [ 0.302, 1, 0, 1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow4',
			// target: 'flowchartWindow11',
			// anchors: [ [ 0.38, 1, 0, 1 ], [ 0.5, 0, 0, -1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow4',
			// target: 'flowchartWindow13',
			// anchors: [ [ 0.928, 1, 0, 1 ], [ 0.06, 0, 0, -1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow11',
			// target: 'flowchartWindow12',
			// anchors: [ [ 0.5, 1, 0, 1 ], [ 0.5, 0, 0, -1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow13',
			// target: 'flowchartWindow14',
			// anchors: [ [ 0.5, 1, 0, 1 ], [ 0.5, 0, 0, -1 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow11',
			// target: 'flowchartWindow14',
			// anchors: [ [ 1, 1, 1, 1 ], [ 0, 0, 0, 0 ] ]
		// });
		// instance.connect({
			// source: 'flowchartWindow13',
			// target: 'flowchartWindow12',
			// anchors: [ [ 0, 1, 0, 0 ], [ 1, 0, 1, 1 ] ]
		// });
		
		//the lines
		instance.connect({
			source: 'flowchartWindow1',
			target: 'flowchartWindow2',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow1',
			target: 'flowchartWindow3',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow2',
			target: 'flowchartWindow4',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow4',
			target: 'flowchartWindow5',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow3',
			target: 'flowchartWindow6',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow3',
			target: 'flowchartWindow7',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow8',
			target: 'flowchartWindow9',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow9',
			target: 'flowchartWindow5',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow10',
			target: 'flowchartWindow9',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow10',
			target: 'flowchartWindow8',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow4',
			target: 'flowchartWindow11',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow4',
			target: 'flowchartWindow13',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow11',
			target: 'flowchartWindow12',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow13',
			target: 'flowchartWindow14',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow11',
			target: 'flowchartWindow14',
			anchors: [ sourceCommon, sourceCommon ]
		});
		instance.connect({
			source: 'flowchartWindow13',
			target: 'flowchartWindow12',
			anchors: [ sourceCommon, sourceCommon ]
		});
		
		//endpoints
		var endpoint = ["Dot", { cssClass:"endpointClass", radius:10, hoverClass:"endpointHoverClass" } ],
		endpointStyle = { fillStyle:'#79B2DA' },
		connector = [ "Flowchart", { cornerRadius:10, stub:0 } ],
		connectorStyle = {
			lineWidth:3,
			strokeStyle:"#3294da"
		},
		anEndpoint = {
			endpoint:endpoint,
			paintStyle:endpointStyle,
			hoverPaintStyle:{ fillStyle:"#449999" },
			isSource:true, 
			isTarget:true, 
			maxConnections:-1, 
			connector:connector,
			connectorStyle:connectorStyle,
		};
		// instance.addEndpoint('flowchartWindow1', anEndpoint, {anchor:'Left'});
		// instance.addEndpoint('flowchartWindow1', anEndpoint, {anchor:'Right'});
		// instance.addEndpoint('flowchartWindow2', anEndpoint, {anchor:[ 0.928, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow3', anEndpoint, {anchor:sourceAnchorsTopChild});
		// instance.addEndpoint('flowchartWindow2', anEndpoint, {anchor:[ 0.928, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow3', anEndpoint, {anchor:[ 0.09, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow3', anEndpoint, {anchor:[ 0.61, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow4', anEndpoint, {anchor:[ 0.928, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow4', anEndpoint, {anchor:'Right'});
		// instance.addEndpoint('flowchartWindow5', anEndpoint, {anchor:[ 0.125, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow5', anEndpoint, {anchor:[ 0.339, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow8', anEndpoint, {anchor:'Left'});
		// instance.addEndpoint('flowchartWindow9', anEndpoint, {anchor:[ 0.31, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow9', anEndpoint, {anchor:[ 0.88, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow9', anEndpoint, {anchor:'Right'});
		// instance.addEndpoint('flowchartWindow10', anEndpoint, {anchor:[ 0.155, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow10', anEndpoint, {anchor:[ 0.725, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow4', anEndpoint, {anchor:[ 0.38, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow4', anEndpoint, {anchor:[ 0.928, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow6', anEndpoint, {anchor:[ 0.9259, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow7', anEndpoint, {anchor:[ 0.502, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow11', anEndpoint, {anchor:[ 0.5, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow11', anEndpoint, {anchor:[ 0.5, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow11', anEndpoint, {anchor:[ 1, 1, 1, 1 ]});
		// instance.addEndpoint('flowchartWindow12', anEndpoint, {anchor:[ 0.5, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow12', anEndpoint, {anchor:[ 1, 0, 1, 1 ]});
		// instance.addEndpoint('flowchartWindow13', anEndpoint, {anchor:[ 0.5, 1, 0, 1 ]});
		// instance.addEndpoint('flowchartWindow13', anEndpoint, {anchor:[ 0, 1, 0, 0 ]});
		// instance.addEndpoint('flowchartWindow13', anEndpoint, {anchor:[ 0.06, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow14', anEndpoint, {anchor:[ 0.5, 0, 0, -1 ]});
		// instance.addEndpoint('flowchartWindow14', anEndpoint, {anchor:[ 0, 0, 0, 0 ]});
	
		for(var i=0; i<$('#plumb .window').size(); i++) {
			for(var j=0; j<sourceCommon.length; j++) {
				instance.addEndpoint('flowchartWindow'+(i+1), anEndpoint, {anchor:sourceCommon[j]});
			}
		}
	
		// bind click listener; delete connections on click
		instance.bind('click', function(conn) {
			instance.detach(conn);
		});
		
		// bind beforeDetach interceptor: will be fired when the click handler above calls detach, and the user
		// will be prompted to confirm deletion.
		instance.bind('beforeDetach', function(conn) {
			return confirm('Удалить соединение?');
		});
		
		instance.bind("connection", function(i,c) { 
			if (typeof console !== "undefined")
				console.log("connection", i.connection); 
		});
		
	});

	//active block
	$('#flowchartWindow7').addClass('active');
	

//menu
$(document).on('click', '.menu .acts .close', function() {
	$(this).parents('.menu').fadeOut();
	return false;
});
$(document).on('click', '.menuUp', function() {
	$(this).siblings('.menu').fadeIn();
	return false;
});

//notes
$(document).on('click', '.notes .close', function() {
	$(this).parents('.notes').fadeOut();
	return false;
});
$(document).on('click', '.notesUp', function() {
	$(this).siblings('.notes').fadeIn();
	return false;
});






});






























