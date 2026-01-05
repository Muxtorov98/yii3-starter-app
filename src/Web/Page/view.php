<?php
use App\Web\Page\Page;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\Csrf;

/** @var Page $page */
/** @var UrlGeneratorInterface $urlGenerator */
/* @var Csrf $csrf */
?>

    <h1><?= Html::a('Pages', $urlGenerator->generate('page/list')) ?> → <?= Html::encode($page->title) ?></h1>

    <p>
        <?= Html::encode($page->text) ?>
    </p>

<?= Html::a('Edit', $urlGenerator->generate('page/edit', ['slug' => $page->getSlug()])) ?> |


<?php
$deleteForm = Html::form()
    ->post($urlGenerator->generate('page/delete', ['slug' => $page->getSlug()]))
    ->csrf($csrf);
?>
<?= $deleteForm->open() ?>
<?= Html::submitButton('Delete') ?>
<?= $deleteForm->close() ?>
