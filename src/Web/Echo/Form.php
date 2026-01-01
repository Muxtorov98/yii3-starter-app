<?php

declare(strict_types=1);

namespace App\Web\Echo;

use Yiisoft\FormModel\FormModel;
use Yiisoft\Validator\Label;
use Yiisoft\Validator\Rule\Length;

final class Form extends FormModel
{
    #[Label('The message to be echoed')]
    #[Length(min: 2)]
    public string $message = '';
}
