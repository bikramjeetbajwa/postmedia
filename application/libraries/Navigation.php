<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation {

    private $ci;
    private $_activeCSS = 'pm_test-active';
    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->config->load('pm_navigation');

        log_message('debug', "Navigation Class Initialized");
    }

    public function getSideNavigation(){
        $htmlNav = '';
        $type = 'sidebar';
        $navArray = $this->ci->config->item($type);
        if(count($navArray) > 0){
            //todo: sorting based on position
            foreach ($navArray as $navItem){
                $active = '';
                $htmlChildren = '';
                if(isset($navItem['children'])){
                    if($this->hasChildren($navItem['children'])){
                        $htmlChildren = "<div class='collapsible-body'><ul>";
                        foreach ($navItem['children'] as $child){
                            $htmlChildren .= "<li><a href='".base_url($child['url'])."' target='".$child['target']."' class='waves-effect'>".$child['title']."</a></li>";
                            if($active == ''){
                                $active = $this->getActiveURL(base_url($child['url']));
                            }
                        }
                        $htmlChildren .= "</ul></div>";
                    }
                }
                if($active == ''){
                    $active = $this->getActiveURL(base_url($navItem['url']));
                }
                $htmlNav .= "<li><a ";
                if($navItem['url'] != ''){
                    $htmlNav .= "href='".base_url($navItem['url'])."' target='".$navItem['target']."' ";
                }
                $htmlNav .= "class='collapsible-header waves-effect arrow-r ".$active."'>";
                $htmlNav .= "<i class='".$navItem['icon']." ".$active."'></i>".$navItem['title'];
                if(isset($navItem['children'])){
                    if($this->hasChildren($navItem['children'])){
                        $htmlNav .= "<i class='fa fa-angle-down rotate-icon'></i></a>";
                        $htmlNav .= $htmlChildren;
                        $htmlNav .= "</li>";
                    }
                    else {
                        $htmlNav .= "</a></li>";
                    }
                }
                else {
                    $htmlNav .= "</a></li>";
                }
            }
        }
        return $htmlNav;
    }

    private function hasChildren($children){
        if(count($children) > 0)
            return true;
        else
            return false;
    }

    private function getActiveURL($navURL){
        $currentURL = current_url();
        if($currentURL == $navURL){
            return $this->_activeCSS;
        }
        return '';
    }



}


