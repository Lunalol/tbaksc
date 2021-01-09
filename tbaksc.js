define(["dojo", "dojo/_base/declare", "ebg/core/gamegui", "ebg/counter"],
	function (dojo, declare)
	{
	    return declare("bgagame.tbaksc", ebg.core.gamegui, {
		constructor: function ()
		{
		    console.log('tbaksc constructor');
		},
		setup: function (gamedatas)
		{
		    console.log("Starting game setup");
		    // DEBUG
		    console.table(gamedatas);
		    // Setting up player boards
		    for (var player_id in gamedatas.players)
		    {
			var player = gamedatas.players[player_id];
		    }
		    //
		    this.turn = parseInt(gamedatas.gameStates.turn);
		    this.numberOfRows = parseInt(gamedatas.gameStates.numberOfRows);
		    this.widthOfRows = parseInt(gamedatas.gameStates.widthOfRows);
		    //
		    var index = 0;
		    for (var spaceCard of Object.values(gamedatas.board))
		    {
			var location = 'tbaksc_space_' + spaceCard.location_arg;
//			var index = parseInt(spaceCard.type_arg);
			var dx = -516 * (index % 2) * 0.2;
			var dy = -744 * Math.floor(index / 2) * 0.2;
			console.log(spaceCard, index, dx, dy);
			var node = dojo.place(this.format_block('jstpl_tbaksc_space', {card_id: spaceCard.id, dx: dx, dy: dy}), 'tbaksc_deck_space');
			this.placeOnObject(node, location);
			dojo.style(node, 'z-index', '100');
			index += 1;
			if (index >= 8) index = 0;
		    }
		    //
		    this.setupNotifications();
		    //
		    console.log("Ending game setup");
		},
		onEnteringState: function (stateName, state)
		{
		    console.log('Entering state: ' + stateName, state.args);
		    switch (stateName)
		    {
			case 'setup':
			    var animations = [];
			    for (var spaceCard of Object.values(state.args.spaceCards))
			    {
				var location = 'tbaksc_space_' + spaceCard.location;
				var node = dojo.place(this.format_block('jstpl_tbaksc_space', {card_id: spaceCard.id}), 'tbaksc_deck_space');
				this.placeOnObject(node, 'tbaksc_deck_space');
				dojo.style(node, 'z-index', '100');
				var animation = this.slideToObject(node, location, 250, 500);
				animations.push(animation);
				dojo.connect(animation, 'onEnd', dojo.hitch(this, function (node, location)
				{
				    this.attachToNewParent(node, location);
				    dojo.style(node, 'z-index', '');
				}, node, location));
			    }
			    dojo.fx.chain(animations).play();
			    break;
			case 'determinePlayerOrder':
			    break;
		    }
		},
		onLeavingState: function (stateName)
		{
		    console.log('Leaving state: ' + stateName);
		    switch (stateName)
		    {
			case 'dummmy':
			    break;
		    }
		},
		onUpdateActionButtons: function (stateName, args)
		{
		    console.log('onUpdateActionButtons: ' + stateName);
		    if (this.isCurrentPlayerActive())
		    {
			switch (stateName)
			{
			}
		    }
		},
		setupNotifications: function ()
		{
		    console.log('notifications subscriptions setup');
		    dojo.subscribe('placeSpaceCard', this, "notif_placeSpaceCard");
		    this.notifqueue.setSynchronous('placeSpaceCard', 1000);
		},
		notif_placeSpaceCard: function (notif)
		{
		    console.log(notif);
		},
	    });
	}
);
