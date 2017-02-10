<?php
defined('_JEXEC') or die;

class modJdArqHelper
{
    public static function getAjax()
    {
        include_once JPATH_ROOT . '/components/com_content/helpers/route.php';

        $input = JFactory::getApplication()->input;
        $data  = $input->get('data', '', 'string');

        // Connect to database
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);


        // Build the query
        $query
            ->select($db->quoteName(array('title','id','catid')))
            ->from($db->quoteName('#__content'))
            ->where($db->quoteName('title') . ' LIKE '. $db->quote('%' . $data . '%')
                . ' AND ' . $db->quoteName('state') . ' = 1')
            ->order('ordering ASC');


        $db->setQuery($query);
        $results = $db->loadObjectList();


        // Get output
        $output = null;

        foreach($results as $result){
            $output .= '<h4><a href="' . ContentHelperRoute::getArticleRoute($result->id,  $result->catid) . '">' . $result->title . '</a></h4>';
        }

        if($output == null or empty($data))
        {
            $output = 'Sorry! No results for your search.';
        }


        return $output;
    }
}