<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Model\OkresRepository;
use App\Model\KrajRepository;
use Nette;
use Nette\Application\Attributes\Persistent;

final class OkresPresenter extends Nette\Application\UI\Presenter
{
    #[Persistent]
    public int $krajId = 0;

    public function __construct(
        private OkresRepository $okresy,
        private KrajRepository $kraje,
    ) {
    }

    public function actionDefault(): void
    {
        // Validace parametru kraje
        if ($this->krajId <= 0 || !$this->kraje->exists($this->krajId)) {
            $this->flashMessage('Neplatný kraj. Vyber kraj ze seznamu.', 'danger');
            $this->redirect('Kraj:default', ['krajId' => null]);
        }
    }

    public function renderDefault(): void
    {
        $this->template->kraj = $this->kraje->get($this->krajId);
        $this->template->okresy = $this->okresy->findByKraj($this->krajId);
    }
}
