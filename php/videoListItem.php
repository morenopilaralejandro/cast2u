<?php 
    //TODO merge with web comp
	function getListItem($video)
	{
		
		$item = "
		<a class='videoListItem' target='_blank' href='view.php?vid=".$video->id_vid."'>
			<img src='".$video->img."' alt='thumb' />
			<span>".$video->title."</span>
		</a>";
		return $item;
	}

	function getPanelItem($video)
	{
		
		$item = "
		<a class='videoPanelItem' href='edit.php?vid=".$video->id_vid."'>
			
				<img src='".$video->img."' alt='thumb' />
			
				<span>".$video->title."</span>
		</a>";
		return $item;
	}




?> 
