<?php
		$nextpage;
		$paginationLink="";
		$pages=ceil($totcount/$rows);
		$curr="<span>".($page+1)."</span>";
		if($totcount>$rows)
		{	///// Add Pagination  ///////
			if ($page > 0)
			{
				$previous=$page - 1;
				if($page > 1)
				{
				$prevpage= "<li><a href=\"javascript:void(0);\" onClick=\"showusermngmntpaging('0');\" title='First page'><i class='glyphicon glyphicon-step-backward'></i></a></li>
				<li><a href=\"javascript:void(0);\" onClick=\"showusermngmntpaging('$previous');\" title='Previous page'><i class='glyphicon glyphicon-chevron-left'></i></a></li>";
				}
				else
				{
				$prevpage= "<li><a href=\"javascript:void(0);\" onClick=\"showusermngmntpaging('$previous');\" title='Previous page'><i class='glyphicon glyphicon-chevron-left'></i></a></li>";
				}
				$paginationLink.=$prevpage;
				}
				if($page < 3)
				{
				$i=0;
				$total=6;
				}
				else
				{
				$i=($page-2);
				$total=$page+3;
				}
				while($i < $total  && $i < $pages)
				{
				if($i == $page)
				{
					$paginationLink.="<li class=active>".$curr."</li>";
				}
				else
				{
				$paginationLink.="<li><a href=\"javascript:void(0);\" onClick=\"showusermngmntpaging('$i');\">".($i+1)."</a></li>";
				}
				++$i;
				}
				if ($page < $pages-1)
				{
				$next=$page + 1;
				if($page < $pages-2)
				{
					$nextpage= "<li><a href=\"javascript:void(0);\" onClick=\"showusermngmntpaging('$next');\" title='Next page'><i class='glyphicon glyphicon-chevron-right'></i></a></li>
					<li><a href=\"javascript:void(0);\" onClick=\"showusermngmntpaging(".($pages-1).");\" title='Last page'><i class='glyphicon glyphicon-step-forward'></i></a></li>";
				}
				else
				{
					$nextpage="<li><a href=\"javascript:void(0);\" onClick=\"showusermngmntpaging('$next');\" title='Last page'><i class='glyphicon glyphicon-step-forward'></i></a></li>";
				}
				$paginationLink.=$nextpage;
				}
				$paginationLink.="";
			}
			else
			{$paginationLink.="&nbsp;&nbsp;&nbsp;";}
	return $paginationLink;
                ?>