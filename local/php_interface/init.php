<?php

AddEventHandler("main", "OnBuildGlobalMenu", array("Ex2", "Ex2_95"));

class Ex2
{
    function Ex2_95(&$aGlobalMenu, &$aModuleMenu)
    {
        global $USER;
        $userGroups = CUser::GetUserGroupList($USER->GetID());

        while ($group = $userGroups->Fetch()) {
            if ($group["GROUP_ID"] == 6 && !$USER->IsAdmin()) {
                unset($aGlobalMenu["global_menu_desktop"]);
                unset($aGlobalMenu["global_menu_landing"]);
                unset($aGlobalMenu["global_menu_marketing"]);
                unset($aGlobalMenu["global_menu_store"]);
                unset($aGlobalMenu["global_menu_services"]);
                unset($aGlobalMenu["global_menu_statistics"]);
                unset($aGlobalMenu["global_menu_marketplace"]);
                unset($aGlobalMenu["global_menu_settings"]);

                foreach ($aModuleMenu as $key => $value) {
                    if ($value["items_id"] != "menu_iblock_/news") {
                        unset($aModuleMenu[$key]);
                    }
                }
            }
        }
    }
}