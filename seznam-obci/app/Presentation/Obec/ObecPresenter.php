<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Model\ObecRepository;
use App\Model\KrajRepository;
use App\Model\OkresRepository;
use Nette;
use Nette\Application\Attributes\Persistent;

final class ObecPresenter extends Nette\Application\UI\Presenter
{
    #[Persistent]
    public int $krajId = 0;

    #[Persistent]
    public int $okresId = 0;

    public function __construct(
        private ObecRepository $obce,
        private KrajRepository $kraje,
        private OkresRepository $okresy,
    ) {
    }

    public function actionDefault(): void
    {
        // Validace parametru okresu i kraje
        if ($this->krajId <= 0 || !$this->kraje->exists($this->krajId)) {
            $this->flashMessage('Neplatný kraj. Vyber znovu.', 'danger');
            $this->redirect('Kraj:default', ['krajId' => null, 'okresId' => null]);
        }
        if ($this->okresId <= 0 || !$this->okresy->belongsToKraj($this->okresId, $this->krajId)) {
            $this->flashMessage('Neplatný okres pro zadaný kraj.', 'danger');
            $this->redirect('Okres:default', ['krajId' => $this->krajId, 'okresId' => null]);
        }
    }

    public function renderDefault(): void
    {
        $this->template->kraj = $this->kraje->get($this->krajId);
        $this->template->okres = $this->okresy->getById($this->okresId);
        $this->template->obce = $this->obce->findByOkres($this->okresId);
    }
}
