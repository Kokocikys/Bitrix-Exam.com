<?
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class koko_complaints extends CModule
{
    var $MODULE_ID = "koko.complaints";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $MODULE_GROUP_RIGHTS = "Y";

    function koko_complaints()
    {
        $arModuleVersion = array();

        include(__DIR__ . '/version.php');

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = Loc::getMessage('COMPLAINTS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('COMPLAINTS_MODULE_DESC');
    }

    function InstallDB($install_wizard = true)
    {
        RegisterModule($this->MODULE_ID);
        return true;
    }

    function UnInstallDB($arParams = array())
    {
        UnRegisterModule($this->MODULE_ID);
        return true;
    }

    function InstallEvents()
    {
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function InstallFiles()
    {
        return true;
    }

    function UnInstallFiles()
    {
        return true;
    }

    function DoInstall()
    {
        $this->InstallFiles();
        $this->InstallDB(false);
    }

    function DoUninstall()
    {
        $this->UnInstallDB(false);
    }
}

?>