<?php defined('C5_EXECUTE') or die('Access Denied.');
?>

<div class="ccm-block-tutorial-list">

<div class="col-md-10 col-md-offset-1">

    <nav class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand">Documents</span>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li <?php if ($sort == 'newest') { ?>class="active"<?php } ?>><a href="<?=$controller->getSearchURL($view, 'sort', 'newest')?>">Newest</a></li>
                <li <?php if ($sort == 'popular') { ?>class="active"<?php } ?>><a href="<?=$controller->getSearchURL($view, 'sort', 'popular')?>">Popular</a></li>
                <li <?php if ($sort == 'trending') { ?>class="active"<?php } ?>><a href="<?=$controller->getSearchURL($view, 'sort', 'trending')?>">Trending</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><button onclick="window.location.href='<?=URL::to('/contribute', 'choose_type', 'tutorial')?>'" class="btn btn-default"><i class="fa fa-plus"></i> New Document</button></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>


    <?php foreach($results as $result) {
        $username = t('Unknown');
        $ui = UserInfo::getByID($result->getCollectionUserID());
        if (is_object($ui)) {
            $username = $ui->getUserDisplayName();
        }
        $inspector = new \Concrete\Package\Concrete5Docs\Page\PageInspector($result);
        ?>

        <article class="tutorial-list-item">
            <div class="tutorial-metadata">
                <ul>
                    <li><i class="fa fa-heart"></i> <?=$inspector->getTotalLikes()?></li>
                    <li><i class="fa fa-comment-o"></i> <?=$inspector->getTotalComments()?></li>
                </ul>
            </div>
            <div class="tutorial-time">
                <?=Core::make('date')->describeInterval(
                    time() - $result->getCollectionDatePublicObject()->getTimestamp()
                )?>
            </div>
            <div class="tutorial-list-item-name"><a href="<?=$result->getCollectionLink()?>"><?=$result->getCollectionName()?></a>
            <span class="tutorial-list-item-byline">By <a href="#"><?=$username?>.</a></span>
            </div>
        </article>

    <?php } ?>

    <?php if ($results->haveToPaginate()) { ?>
        <?=$results->renderDefaultView()?>
    <?php } ?>
</div>

</div>
