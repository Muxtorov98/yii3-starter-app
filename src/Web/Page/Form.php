<?php

declare(strict_types=1);

namespace App\Web\Page;

use Yiisoft\FormModel\FormModel;
use Yiisoft\Validator\Label;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Required;

final class Form extends FormModel
{
    #[Label('The title to be echoed')]
    #[Length(min: 2)]
    #[Required]
    public string $title = '';

    #[Label('The text to be echoed')]
    #[Length(min: 2)]
    public string $text = '';
}
