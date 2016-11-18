<?php
use yii\bootstrap\Nav;
use mdm\admin\components\MenuHelper;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->getIdentity()->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php
            $item[0] = [
                ['label' => '管理员', 'options' => ['class' => 'header']],
                [
                    'label' => '权限管理',
                    'icon' => 'fa fa-cogs',
                    'url' => '#',
                    'items' => [
                        ['label' => '路由列表', 'icon' => 'fa fa-file', 'url' => ['/admin/route']],
                        ['label' => '权限列表', 'icon' => 'fa fa-legal', 'url' => ['/admin/permission']],
                        ['label' => '角色列表', 'icon' => 'fa fa-male', 'url' => ['/admin/role']],
                        ['label' => '菜单列表', 'icon' => 'fa fa-list', 'url' => ['/admin/menu']],
                        ['label' => '分配列表', 'icon' => 'fa fa-arrows', 'url' => ['/admin/assignment']],
                    ]
                ],
                ['label' => '开发环境', 'options' => ['class' => 'header']],
                ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ['label' => '后台管理', 'options' => ['class' => 'header']], // here
            ];
            $item[1] = MenuHelper::getAssignedMenu(Yii::$app->user->id);
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => yii\helpers\ArrayHelper::merge($item[0],$item[1])
            ]
        ) ?>
<!--        MenuHelper::getAssignedMenu(Yii::$app->user->id)-->


    </section>

</aside>
