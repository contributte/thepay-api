<?php declare(strict_types = 1);

namespace Tp;

/**
 * VAT detail informations for EET.
 */
class EetDph
{

	/** @var float|null Celková částka plnění osvobozených od DPH, ostatních plnění */
	protected $eetZaklNepodlDph = null;

	/** @var float|null Celkový základ daně se základní sazbou DPH */
	protected $eetZaklDan1 = null;

	/** @var float|null Celková DPH se základní sazbou */
	protected $eetDan1 = null;

	/** @var float|null Celkový základ daně s první sníženou sazbou DPH */
	protected $eetZaklDan2 = null;

	/** @var float|null Celková DPH s první sníženou sazbou */
	protected $eetDan2 = null;

	/** @var float|null Celkový základ daně s druhou sníženou sazbou DPH */
	protected $eetZaklDan3 = null;

	/** @var float|null Celková DPH s druhou sníženou sazbou */
	protected $eetDan3 = null;

	/** @var float|null Celková částka v režimu DPH pro cestovní službu */
	protected $eetCestSluz = null;

	/** @var float|null Celková částka v režimu DPH pro prodej použitého zboží se základní sazbou */
	protected $eetPouzitZboz1 = null;

	/** @var float|null Celková částka v režimu DPH pro prodej použitého zboží s první sníženou sazbou */
	protected $eetPouzitZboz2 = null;

	/** @var float|null Celková částka v režimu DPH pro prodej použitého zboží s druhou sníženou sazbou */
	protected $eetPouzitZboz3 = null;

	/** @var float|null Celková částka plateb určená k následnému čerpání nebo zúčtování */
	protected $eetUrcenoCerpZuct = null;

	/** @var float|null Celková částka plateb, které jsou následným čerpáním nebo zúčtováním platby */
	protected $eetCerpZuct = null;

	public function getZaklNepodlDph(): ?float
	{
		return $this->eetZaklNepodlDph;
	}

	public function getZaklDan1(): ?float
	{
		return $this->eetZaklDan1;
	}

	public function getDan1(): ?float
	{
		return $this->eetDan1;
	}

	public function getZaklDan2(): ?float
	{
		return $this->eetZaklDan2;
	}

	public function getDan2(): ?float
	{
		return $this->eetDan2;
	}

	public function getZaklDan3(): ?float
	{
		return $this->eetZaklDan3;
	}

	public function getDan3(): ?float
	{
		return $this->eetDan3;
	}

	public function getCestSluz(): ?float
	{
		return $this->eetCestSluz;
	}

	public function getPouzitZboz1(): ?float
	{
		return $this->eetPouzitZboz1;
	}

	public function getPouzitZboz2(): ?float
	{
		return $this->eetPouzitZboz2;
	}

	public function getPouzitZboz3(): ?float
	{
		return $this->eetPouzitZboz3;
	}

	public function getUrcenoCerpZuct(): ?float
	{
		return $this->eetUrcenoCerpZuct;
	}

	public function getCerpZuct(): ?float
	{
		return $this->eetCerpZuct;
	}

	/**
	 * @param float $zaklNepodlDph Celková částka plnění osvobozených od DPH, ostatních plnění
	 */
	public function setZaklNepodlDph(float $zaklNepodlDph): void
	{
		$this->eetZaklNepodlDph = $zaklNepodlDph;
	}

	/**
	 * @param float $zaklDan1 Celkový základ daně se základní sazbou DPH
	 */
	public function setZaklDan1(float $zaklDan1): void
	{
		$this->eetZaklDan1 = $zaklDan1;
	}

	/**
	 * @param float $dan1 Celková DPH se základní sazbou
	 */
	public function setDan1(float $dan1): void
	{
		$this->eetDan1 = $dan1;
	}

	/**
	 * @param float $zaklDan2 Celkový základ daně s první sníženou sazbou DPH
	 */
	public function setZaklDan2(float $zaklDan2): void
	{
		$this->eetZaklDan2 = $zaklDan2;
	}

	/**
	 * @param float $dan2 Celková DPH s první sníženou sazbou
	 */
	public function setDan2(float $dan2): void
	{
		$this->eetDan2 = $dan2;
	}

	/**
	 * @param float $zaklDan3 Celkový základ daně s druhou sníženou sazbou DPH
	 */
	public function setZaklDan3(float $zaklDan3): void
	{
		$this->eetZaklDan3 = $zaklDan3;
	}

	/**
	 * @param float $dan3 Celková DPH s druhou sníženou sazbou
	 */
	public function setDan3(float $dan3): void
	{
		$this->eetDan3 = $dan3;
	}

	/**
	 * @param float $cestSluz Celková částka v režimu DPH pro cestovní službu
	 */
	public function setCestSluz(float $cestSluz): void
	{
		$this->eetCestSluz = $cestSluz;
	}

	/**
	 * @param float $pouzitZboz1 Celková částka v režimu DPH pro prodej použitého zboží se základní sazbou
	 */
	public function setPouzitZboz1(float $pouzitZboz1): void
	{
		$this->eetPouzitZboz1 = $pouzitZboz1;
	}

	/**
	 * @param float $pouzitZboz2 Celková částka v režimu DPH pro prodej použitého zboží s první sníženou sazbou
	 */
	public function setPouzitZboz2(float $pouzitZboz2): void
	{
		$this->eetPouzitZboz2 = $pouzitZboz2;
	}

	/**
	 * @param float $pouzitZboz3 Celková částka v režimu DPH pro prodej použitého zboží s druhou sníženou sazbou
	 */
	public function setPouzitZboz3(float $pouzitZboz3): void
	{
		$this->eetPouzitZboz3 = $pouzitZboz3;
	}

	/**
	 * @param float $urcenoCerpZuct Celková částka plateb určená k následnému čerpání nebo zúčtování
	 */
	public function setUrcenoCerpZuct(float $urcenoCerpZuct): void
	{
		$this->eetUrcenoCerpZuct = $urcenoCerpZuct;
	}

	/**
	 * @param float $cerpZuct Celková částka plateb, které jsou následným čerpáním nebo zúčtováním platby
	 */
	public function setCerpZuct(float $cerpZuct): void
	{
		$this->eetCerpZuct = $cerpZuct;
	}

	/**
	 * @return string[] values as array for parameters/signature
	 */
	public function toArray(): array
	{
		$resultArr = [];
		foreach (get_object_vars($this) as $name => $value) {
			if ($value !== null && $value !== '' && $value !== 0) {
				$resultArr[$name] = number_format($value, 2, '.', '');
			}
		}

		return $resultArr;
	}

	/**
	 * @return bool true if this object is empty (all fields are null or zero)
	 */
	public function isEmpty(): bool
	{
		foreach (get_object_vars($this) as $value) {
			if ($value !== null && $value !== '' && $value !== 0) {
				return false;
			}
		}

		return true;
	}

}
