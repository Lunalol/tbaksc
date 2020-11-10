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
		onEnteringState: function (stateName, args)
		{
		    console.log('Entering state: ' + stateName);
		    switch (stateName)
		    {
			case 'dummmy':
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

		    // TODO: here, associate your game notifications with local methods

		    // Example 1: standard notification handling
		    // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );

		    // Example 2: standard notification handling + tell the user interface to wait
		    //            during 3 seconds after calling the method in order to let the players
		    //            see what is happening in the game.
		    // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
		    // this.notifqueue.setSynchronous( 'cardPlayed', 3000 );
		    //
		}
	    });
	});
