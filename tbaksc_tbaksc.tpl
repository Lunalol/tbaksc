{OVERALL_GAME_HEADER}

<div style='position:relative;display:flex;margin: 0 auto;'>
    <div class="tbaksc_deck" id="tbaksc_deck_space}" style="width: {WIDTH}px;height: {HEIGHT}px;">tbaksc_deck_space</div>
    <div class='tbaksc_board' id='tbaksc_board' style='grid-template-columns:repeat({WIDTHOFROWS}, {WIDTH}px);grid-template-rows: repeat({NUMBEROFROWS}, {HEIGHT}px'>
	<!-- BEGIN tbaksc_space -->
	<div class="tbaksc_space" id="tbaksc_space_{ID}" style="width: {WIDTH}px;height: {HEIGHT}px;"></div>
	<!-- END tbaksc_space -->
    </div>
    <div class="tbaksc_deck" id="tbaksc_deck_space}" style="width: {WIDTH}px;height: {HEIGHT}px;">tbaksc_deck_space</div>
</div>
<script type="text/javascript">
    var jstpl_tbaksc_card = '<div class="tbaksc_card" id="tbaksc_card_${ID}">${ID}</div>';
</script>

{OVERALL_GAME_FOOTER}
