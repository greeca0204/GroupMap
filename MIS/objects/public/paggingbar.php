<?php

function genPaggingbar($action, $pageNum, $totalPages, $max=10) {
	$paggingBar = '';
	if($totalPages > 1) {
		if(strpos($action,'?')===false) $action.='?';
		$start = $pageNum - intval($max/2);
		if($start <= 0) $start = 1;
		if($totalPages - ($max-1) < $start && $totalPages >= ($max-1)) $start = $totalPages - ($max-1);

		$end = $start + $max;
		if($end > $totalPages) $end = $totalPages;

		$bar = '';
		for($i=$start; $i<=$end; $i++) {
			if($i == $pageNum) $bar.= "<a class=\"current\">$pageNum</a>";
			else $bar.= "<a href=\"$action&page_num=$i\">$i</a>";
		}
		$paggingBar = "<div class=\"pagingBarNum\">";
		if($pageNum>$max)
		$paggingBar.= "<a href=\"$action&page_num=1\">首页</a>";
		if($pageNum>1)
		$paggingBar.= "<a href=\"$action&page_num=".($pageNum-1)."\">上一页</a>";
		else
		$paggingBar.= "<a class=\"gray\">上一页</a>";
		$paggingBar.= $bar;
		if($totalPages-$pageNum>$pageNum-$max)
		$paggingBar.= "<a href=\"$action&page_num=$totalPages\">..$totalPages</a>";
		if($pageNum<$totalPages)
		$paggingBar.= "<a href=\"$action&page_num=".($pageNum+1)."\">下一页</a>";
		else
		$paggingBar.= "<a class=\"gray\">下一页</a>";
		$paggingBar.= "</div>";
	}
	return $paggingBar;
}

?>