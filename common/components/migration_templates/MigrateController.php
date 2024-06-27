<?php 
namespace common\components\migration_templates;

use Yii;
use yii\console\controllers\MigrateController as BaseMigrateController;

class MigrateController extends BaseMigrateController
{
    /**
     * @inheritdoc
     */
    public $templateFile = '@common/components/migration_templates/create_table.php';

    public function actionCreate($name)
    {
        echo "Using custom migration controller...\n";
        parent::actionCreate($name);
    }
}
