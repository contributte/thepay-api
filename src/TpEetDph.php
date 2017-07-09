<?php
/**
 * VAT detail informations for EET.
 */
class TpEetDph{
	/**
	 * @var float Celková částka plnění osvobozených od DPH, ostatních plnění
	 */
	protected $eetZaklNepodlDph = NULL;
	/**
	 * @var float Celkový základ daně se základní sazbou DPH
	 */
	protected $eetZaklDan1 = NULL;
	/**
	 * @var float Celková DPH se základní sazbou
	 */
	protected $eetDan1 = NULL;
	/**
	 * @var float Celkový základ daně s první sníženou sazbou DPH
	 */
	protected $eetZaklDan2 = NULL;
	/**
	 * @var float Celková DPH s první sníženou sazbou
	 */
	protected $eetDan2 = NULL;
	/**
	 * @var float Celkový základ daně s druhou sníženou sazbou DPH
	 */
	protected $eetZaklDan3 = NULL;
	/**
	 * @var float Celková DPH s druhou sníženou sazbou
	 */
	protected $eetDan3 = NULL;
	/**
	 * @var float Celková částka v režimu DPH pro cestovní službu
	 */
	protected $eetCestSluz = NULL;
	/**
	 * @var float Celková částka v režimu DPH pro prodej použitého zboží se základní sazbou
	 */
	protected $eetPouzitZboz1 = NULL;
	/**
	 * @var float Celková částka v režimu DPH pro prodej použitého zboží s první sníženou sazbou
	 */
	protected $eetPouzitZboz2 = NULL;
	/**
	 * @var float Celková částka v režimu DPH pro prodej použitého zboží s druhou sníženou sazbou
	 */
	protected $eetPouzitZboz3 = NULL;
	/**
	 * @var float Celková částka plateb určená k následnému čerpání nebo zúčtování
	 */
	protected $eetUrcenoCerpZuct = NULL;
	/**
	 * @var float Celková částka plateb, které jsou následným čerpáním nebo zúčtováním platby
	 */
	protected $eetCerpZuct = NULL;
	
	function getZaklNepodlDph() {
		return $this->eetZaklNepodlDph;
	}

	function getZaklDan1() {
		return $this->eetZaklDan1;
	}
	function getDan1() {
		return $this->eetDan1;
	}

	function getZaklDan2() {
		return $this->eetZaklDan2;
	}

	function getDan2() {
		return $this->eetDan2;
	}

	function getZaklDan3() {
		return $this->eetZaklDan3;
	}

	function getDan3() {
		return $this->eetDan3;
	}

	function getCestSluz() {
		return $this->eetCestSluz;
	}

	function getPouzitZboz1() {
		return $this->eetPouzitZboz1;
	}

	function getPouzitZboz2() {
		return $this->eetPouzitZboz2;
	}

	function getPouzitZboz3() {
		return $this->eetPouzitZboz3;
	}

	function getUrcenoCerpZuct() {
		return $this->eetUrcenoCerpZuct;
	}

	function getCerpZuct() {
		return $this->eetCerpZuct;
	}

	/**
	 * @param float $zaklNepodlDph Celková částka plnění osvobozených od DPH, ostatních plnění
	 */
	function setZaklNepodlDph($zaklNepodlDph) {
		$this->eetZaklNepodlDph = $zaklNepodlDph;
	}

	/**
	 * @param float $zaklDan1 Celkový základ daně se základní sazbou DPH
	 */
	function setZaklDan1($zaklDan1) {
		$this->eetZaklDan1 = $zaklDan1;
	}
	
	/**
	 * @param float $dan1 Celková DPH se základní sazbou
	 */
	function setDan1($dan1) {
		$this->eetDan1 = $dan1;
	}

	/**
	 * @param float $zaklDan2 Celkový základ daně s první sníženou sazbou DPH
	 */
	function setZaklDan2($zaklDan2) {
		$this->eetZaklDan2 = $zaklDan2;
	}

	/**
	 * @param float $dan2 Celková DPH s první sníženou sazbou
	 */
	function setDan2($dan2) {
		$this->eetDan2 = $dan2;
	}

	/**
	 * @param float $zaklDan3 Celkový základ daně s druhou sníženou sazbou DPH
	 */
	function setZaklDan3($zaklDan3) {
		$this->eetZaklDan3 = $zaklDan3;
	}

	/**
	 * @param float $dan3 Celková DPH s druhou sníženou sazbou
	 */
	function setDan3($dan3) {
		$this->eetDan3 = $dan3;
	}

	/**
	 * @param float $cestSluz Celková částka v režimu DPH pro cestovní službu
	 */
	function setCestSluz($cestSluz) {
		$this->eetCestSluz = $cestSluz;
	}

	/**
	 * @param float $pouzitZboz1 Celková částka v režimu DPH pro prodej použitého zboží se základní sazbou
	 */
	function setPouzitZboz1($pouzitZboz1) {
		$this->eetPouzitZboz1 = $pouzitZboz1;
	}

	/**
	 * @param float $pouzitZboz2 Celková částka v režimu DPH pro prodej použitého zboží s první sníženou sazbou
	 */
	function setPouzitZboz2($pouzitZboz2) {
		$this->eetPouzitZboz2 = $pouzitZboz2;
	}

	/**
	 * @param float $pouzitZboz3 Celková částka v režimu DPH pro prodej použitého zboží s druhou sníženou sazbou
	 */
	function setPouzitZboz3($pouzitZboz3) {
		$this->eetPouzitZboz3 = $pouzitZboz3;
	}

	/**
	 * @param float $urcenoCerpZuct Celková částka plateb určená k následnému čerpání nebo zúčtování
	 */
	function setUrcenoCerpZuct($urcenoCerpZuct) {
		$this->eetUrcenoCerpZuct = $urcenoCerpZuct;
	}

	/**
	 * @param float $cerpZuct Celková částka plateb, které jsou následným čerpáním nebo zúčtováním platby
	 */
	function setCerpZuct($cerpZuct) {
		$this->eetCerpZuct = $cerpZuct;
	}

	/**
	 * @return array values as array for parameters/signature
	 */
	public function toArray() {
		$resultArr = array();
		foreach(get_object_vars($this) as $name => $value){
			if( ! empty($value)){
				$resultArr[$name] = number_format($value, 2, '.', '');
			}
		}
		return $resultArr;
	}
	
	/**
	 * 
	 * @return boolean true if this object is empty (all fields are null or zero)
	 */
	public function isEmpty(){
		foreach(get_object_vars($this) as $value){
			if( ! empty($value)){
				return false;
			}
		}
		return true;
	}
}