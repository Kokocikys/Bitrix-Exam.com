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

    public function InstallDB()
    {
        RegisterModule($this->MODULE_ID);
        \Bitrix\Main\Loader::includeModule($this->MODULE_ID);
        $connection = \Bitrix\Main\Application::getConnection();
        $this->createMyTable($connection);
        return true;
    }

    protected function createMyTable(\Bitrix\Main\DB\Connection $connection)
    {
        $tableName = \Koko\Complaints\ComplaintTable::getTableName();
        if (!$connection->isTableExists($tableName)) {
            $connection->createTable(\Koko\Complaints\ComplaintTable::getTableName(),
                \Koko\Complaints\ComplaintTable::getMap());
        }
    }

    function UnInstallDB($arParams = array())
    {
        \Bitrix\Main\Loader::includeModule($this->MODULE_ID);
        $connection = \Bitrix\Main\Application::getConnection();
        $this->dropMyTable($connection);
        UnRegisterModule($this->MODULE_ID);
        return true;
    }

    protected function dropMyTable(\Bitrix\Main\DB\Connection $connection)
    {
        $tableName = \Koko\Complaints\ComplaintTable::getTableName();
        if ($connection->isTableExists($tableName)) {
            $connection->dropTable(\Koko\Complaints\ComplaintTable::getTableName());
        }
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
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/local/modules/koko.complaints/install/components", $_SERVER["DOCUMENT_ROOT"] . "/local/components", True, True);
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