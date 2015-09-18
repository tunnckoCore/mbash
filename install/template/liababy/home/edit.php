<?php
if(defined('CERR_HANDLER')) error_reporting(-1);

?>

	<section>
		<h3>Редактиране на новина</h3>
		<ul>
			<li>
				<div class="article-item">
<?php

foreach ($this->setEditData as $k => $val) {
	$newsSEOurl = str_replace("-", " ", $val['newsSEOurl']);
	$newsSEO = str_replace(".html", "", $newsSEOurl);

    echo '<form action="'.$val['MAIN_PATH'].'home/editNew/' . $val['newsID'] . '" method="post">
    <p>
        News name: <input type="text" name="newsName" value="' . $val['newsName'] . '" /><br/>
       SEO Url: <input type="text" name="newsSEOurl" value="' . $newsSEO . '" /><br/>
        News title: <input type="text" name="newsTitle" value="' . $val['newsTitle'] . '" /><br/>
        News tags: <input type="text" name="newsTags" value="' . $val['newsTags'] . '" /><br/>
        News text: <textarea name="newsText">' . $val['newsText'] . '</textarea><br/>
        <input type="submit" class="button" name="edit" value="EDIT" />
    </p>	
</form>';

}
?>
</div>
			</li>
		</ul>
	 </section>