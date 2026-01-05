<?php
use App\Web\Page\Page;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;

/** @var iterable<Page> $pages */
/** @var UrlGeneratorInterface $urlGenerator */
?>

    <ul>
        <?php foreach ($pages as $page): ?>
            <li>
                <?= Html::a($page->title, $urlGenerator->generate('page/view', ['slug' => $page->getSlug()])) ?>
            </li>
        <?php endforeach ?>
    </ul>

<?= Html::a('Create', $urlGenerator->generate('page/edit', ['slug' => 'new'])) ?>
