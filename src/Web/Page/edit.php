<?php
use App\Web\Page\Form;
use Yiisoft\FormModel\Field;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\Csrf;

/**
 * @var Form $form
 * @var string[] $errors
 * @var UrlGeneratorInterface $urlGenerator
 * @var Csrf $csrf
 * @var bool $isNew
 * @var string $slug
 */

$htmlForm = Html::form()
    ->post($urlGenerator->generate('page/edit', ['slug' => $slug]))
    ->csrf($csrf);
?>

<?= $htmlForm->open() ?>
<?= Field::text($form, 'title')->required() ?>
<?= Field::textarea($form, 'text')->required() ?>
<?= Html::submitButton('Save') ?>
<?= $htmlForm->close() ?>
