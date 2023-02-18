<?php

namespace common\models;


class WidgetStyleVic{

    public static function PagerStylePagination($pagination){
        return [
            'pagination' => $pagination,
            //Css option for container
            'options' => ['class' => 'pagination'],
            //First option value
            'firstPageLabel' => 'Primera',
            //Last option value
            'lastPageLabel' => 'Última',
            //Previous option value
            'prevPageLabel' => '&lt;&lt;',
            //Next option value
            'nextPageLabel' => '&gt;&gt;',
            //Current Active option value
            'activePageCssClass' => 'active',
            //Max count of allowed options
            'maxButtonCount' => 8,
        
            // Css for each options. Links
            'linkOptions' => ['class' => 'page-link'],
            'disabledPageCssClass' => 'page-link disabled',
        
            // Customzing CSS class for navigating link
            /*   'prevPageCssClass' => 'p-back',
            'nextPageCssClass' => 'p-next',
            'firstPageCssClass' => 'p-first',
            'lastPageCssClass' => 'p-last', */

        ];
    }
    public static function PagerStyle(){
        return [
             
            //First option value
            'firstPageLabel' => 'Primera',
            //Last option value
            'lastPageLabel' => 'Última',
            //Previous option value
            'prevPageLabel' => '&lt;&lt;',
            //Next option value
            'nextPageLabel' => '&gt;&gt;',
            //Current Active option value
            'activePageCssClass' => 'active',
            //Max count of allowed options
            'maxButtonCount' => 8,
        
            // Css for each options. Links
            'linkOptions' => ['class' => 'page-link'],
            'disabledPageCssClass' => 'page-link disabled',
        
            // Customzing CSS class for navigating link
            /*   'prevPageCssClass' => 'p-back',
            'nextPageCssClass' => 'p-next',
            'firstPageCssClass' => 'p-first',
            'lastPageCssClass' => 'p-last', */

        ];
    }

}