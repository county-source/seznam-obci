<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Model\KrajRepository;
use Nette;

final class KrajPresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private KrajRepository $kraje,
    ) {
    }

    public function renderDefault(): void
    {
        $this->template->kraje = $this->kraje->findAll();
    }
}
