<?php 
use backend\models\Menu;
use backend\models\AuthItem;
use backend\models\AuthAssignment;
use backend\models\AuthItemChild;
    $query = new \yii\db\Query;
    $query = $query->select('M1.*,M2.name as Menu_Pai')
            ->from(Menu::tableName().' AS M1')
            ->join('join',Menu::tableName().' AS M2')
            ->join('join',AuthItem::tableName().' AS A')
            ->join('join',AuthAssignment::tableName().' AS P')
            ->join('join',AuthItemChild::tableName().' AS C')
            ->where('M1.parent=M2.id and M1.route = A.name')
            ->andWhere('P.item_name=:role',[':role'=>Yii::$app->session->get('role')])
            ->andWhere('P.user_id=:id',[':id'=>\Yii::$app->user->identity->id])
            ->andWhere('C.child = M1.route')
            ->andWhere('C.parent = P.item_name')
            ->all();
    $menus = null;
    if(!empty($query)){
        foreach ($query as $key => $menu) {
            $menus[$menu['Menu_Pai']][] = $menu;
        }
    }
?>
<div class="main_container">
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view"> 
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><img src="<?= \Yii::$app->request->baseUrl.'/images/icons/avatar.png'?>" alt="..." class="img-circle profile_img" style="width: 30px;height: 30px;margin-top: auto;"/> <span>Template</span></a>
            </div>
            
            <div class="clearfix"></div>
     
            <br>
            <div class="main_menu_side hidden-print main_menu" id="sidebar-menu">
                <div class="menu_section">
                    <ul class="nav side-menu">
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i><span>&nbsp;Home</span></a></li>
                    <?php 
                        if(!empty($menus)){
                            foreach ($menus as $key => $menu) {?>
                                <ul class="nav side-menu">
                                  <li><a><i class=""></i> <?= $key?> <span class="fa fa-plus-square"></span></a>
                                    <ul class="nav child_menu">
                                        <?php foreach ($menu as $key => $main) {?>
                                            <li>
                                                <a href="<?= \yii\helpers\Url::to('index.php?r='.$main['route'])?>"><?= $main['name']?>
                                                </a>
                                            </li>                                                
                                        <?php }//fim de segundo for ?>
                                    </ul>
                                  </li>
                                </ul>
                      <?php }//fim de primeiro for
                        }?>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>