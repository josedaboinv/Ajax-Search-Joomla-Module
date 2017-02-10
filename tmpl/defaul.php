<?php defined('_JEXEC') or die;
$document = JFactory::getDocument(); //I add this piece of code
$document->addScript('//code.jquery.com/jquery-latest.min.js');  //I add this piece of code
?>

<form>
    <input type="text" name="data" />
    <input type="submit" value="Search articles" />
</form>
<div class="search-results"></div>
