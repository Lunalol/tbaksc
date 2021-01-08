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
		    for (let row = 0; row < this.numberOfRows; row++)
		    {
			for (let col = 0; col < this.widthOfRows; col++)
			{
			    let index = (row + this.turn) * this.widthOfRows + col;
			    if (index < Object.keys(gamedatas.board).length)
			    {
				let card = gamedatas.board[index + 1];
				console.log(row, col);
			    }
			}
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
				var node = dojo.place(this.format_block('jstpl_tbaksc_space', {card_id: spaceCard.card_id}), 'tbaksc_deck_space');
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
			    debugger;
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
