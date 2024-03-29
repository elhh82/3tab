<?php


abstract class BaseTeamScoreSheet extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $adjudicator_allocation_id;


	
	protected $debate_team_xref_id;


	
	protected $score;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aAdjudicatorAllocation;

	
	protected $aDebateTeamXref;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getAdjudicatorAllocationId()
	{

		return $this->adjudicator_allocation_id;
	}

	
	public function getDebateTeamXrefId()
	{

		return $this->debate_team_xref_id;
	}

	
	public function getScore()
	{

		return $this->score;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TeamScoreSheetPeer::ID;
		}

	} 
	
	public function setAdjudicatorAllocationId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->adjudicator_allocation_id !== $v) {
			$this->adjudicator_allocation_id = $v;
			$this->modifiedColumns[] = TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID;
		}

		if ($this->aAdjudicatorAllocation !== null && $this->aAdjudicatorAllocation->getId() !== $v) {
			$this->aAdjudicatorAllocation = null;
		}

	} 
	
	public function setDebateTeamXrefId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->debate_team_xref_id !== $v) {
			$this->debate_team_xref_id = $v;
			$this->modifiedColumns[] = TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID;
		}

		if ($this->aDebateTeamXref !== null && $this->aDebateTeamXref->getId() !== $v) {
			$this->aDebateTeamXref = null;
		}

	} 
	
	public function setScore($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->score !== $v) {
			$this->score = $v;
			$this->modifiedColumns[] = TeamScoreSheetPeer::SCORE;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = TeamScoreSheetPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = TeamScoreSheetPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->adjudicator_allocation_id = $rs->getInt($startcol + 1);

			$this->debate_team_xref_id = $rs->getInt($startcol + 2);

			$this->score = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TeamScoreSheet object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TeamScoreSheetPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TeamScoreSheetPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TeamScoreSheetPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(TeamScoreSheetPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TeamScoreSheetPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aAdjudicatorAllocation !== null) {
				if ($this->aAdjudicatorAllocation->isModified()) {
					$affectedRows += $this->aAdjudicatorAllocation->save($con);
				}
				$this->setAdjudicatorAllocation($this->aAdjudicatorAllocation);
			}

			if ($this->aDebateTeamXref !== null) {
				if ($this->aDebateTeamXref->isModified()) {
					$affectedRows += $this->aDebateTeamXref->save($con);
				}
				$this->setDebateTeamXref($this->aDebateTeamXref);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TeamScoreSheetPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TeamScoreSheetPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aAdjudicatorAllocation !== null) {
				if (!$this->aAdjudicatorAllocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAdjudicatorAllocation->getValidationFailures());
				}
			}

			if ($this->aDebateTeamXref !== null) {
				if (!$this->aDebateTeamXref->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDebateTeamXref->getValidationFailures());
				}
			}


			if (($retval = TeamScoreSheetPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TeamScoreSheetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAdjudicatorAllocationId();
				break;
			case 2:
				return $this->getDebateTeamXrefId();
				break;
			case 3:
				return $this->getScore();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TeamScoreSheetPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAdjudicatorAllocationId(),
			$keys[2] => $this->getDebateTeamXrefId(),
			$keys[3] => $this->getScore(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TeamScoreSheetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAdjudicatorAllocationId($value);
				break;
			case 2:
				$this->setDebateTeamXrefId($value);
				break;
			case 3:
				$this->setScore($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TeamScoreSheetPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAdjudicatorAllocationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDebateTeamXrefId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setScore($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TeamScoreSheetPeer::DATABASE_NAME);

		if ($this->isColumnModified(TeamScoreSheetPeer::ID)) $criteria->add(TeamScoreSheetPeer::ID, $this->id);
		if ($this->isColumnModified(TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID)) $criteria->add(TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID, $this->adjudicator_allocation_id);
		if ($this->isColumnModified(TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID)) $criteria->add(TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID, $this->debate_team_xref_id);
		if ($this->isColumnModified(TeamScoreSheetPeer::SCORE)) $criteria->add(TeamScoreSheetPeer::SCORE, $this->score);
		if ($this->isColumnModified(TeamScoreSheetPeer::CREATED_AT)) $criteria->add(TeamScoreSheetPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TeamScoreSheetPeer::UPDATED_AT)) $criteria->add(TeamScoreSheetPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TeamScoreSheetPeer::DATABASE_NAME);

		$criteria->add(TeamScoreSheetPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setAdjudicatorAllocationId($this->adjudicator_allocation_id);

		$copyObj->setDebateTeamXrefId($this->debate_team_xref_id);

		$copyObj->setScore($this->score);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TeamScoreSheetPeer();
		}
		return self::$peer;
	}

	
	public function setAdjudicatorAllocation($v)
	{


		if ($v === null) {
			$this->setAdjudicatorAllocationId(NULL);
		} else {
			$this->setAdjudicatorAllocationId($v->getId());
		}


		$this->aAdjudicatorAllocation = $v;
	}


	
	public function getAdjudicatorAllocation($con = null)
	{
		if ($this->aAdjudicatorAllocation === null && ($this->adjudicator_allocation_id !== null)) {
						include_once 'lib/model/om/BaseAdjudicatorAllocationPeer.php';

			$this->aAdjudicatorAllocation = AdjudicatorAllocationPeer::retrieveByPK($this->adjudicator_allocation_id, $con);

			
		}
		return $this->aAdjudicatorAllocation;
	}

	
	public function setDebateTeamXref($v)
	{


		if ($v === null) {
			$this->setDebateTeamXrefId(NULL);
		} else {
			$this->setDebateTeamXrefId($v->getId());
		}


		$this->aDebateTeamXref = $v;
	}


	
	public function getDebateTeamXref($con = null)
	{
		if ($this->aDebateTeamXref === null && ($this->debate_team_xref_id !== null)) {
						include_once 'lib/model/om/BaseDebateTeamXrefPeer.php';

			$this->aDebateTeamXref = DebateTeamXrefPeer::retrieveByPK($this->debate_team_xref_id, $con);

			
		}
		return $this->aDebateTeamXref;
	}

} 