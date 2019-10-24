<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?= \Yii::$app->request->baseUrl.'/images/icons/avatar.png'?>" alt="">
                        <?php 
                            if(!Yii::$app->user->isGuest){
                                echo Yii::$app->user->identity->username;
                            }
                        ?> 
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                         <?=yii\helpers\Html::a('<i class="fa fa-sign-out pull-right" aria-hidden="true"></i> Log Out',['/site/logout']);?>
                         </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>