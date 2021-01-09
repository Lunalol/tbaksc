{OVERALL_GAME_HEADER}

<div class="tbaksc">
    <div class="tbaksc_deck" id="tbaksc_deck_space1"></div>
    <div class="tbaksc_board" id="tbaksc_board" style="grid-template-columns:repeat({WIDTHOFROWS}, var(--WIDTH));grid-template-rows: repeat({NUMBEROFROWS}, var(--HEIGHT)">
	<!-- BEGIN tbaksc_space -->
	<div class="tbaksc_deck" id="tbaksc_space_{ID}"></div>
	<!-- END tbaksc_space -->
    </div>
    <div class="tbaksc_deck" id="tbaksc_deck_space"></div>
</div>
<script type="text/javascript">
    var jstpl_tbaksc_space = '<div class="tbaksc_deck tbaksc_space" id="tbaksc_card_${card_id}", style="background-position:${dx}px ${dy}px;"></div>';
</script>

{OVERALL_GAME_FOOTER}
